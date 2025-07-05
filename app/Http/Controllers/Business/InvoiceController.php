<<<<<<< HEAD
<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessInvoice;
use App\Models\BusinessInvoiceItem;
use App\Models\BusinessClient;
use App\Models\BusinessProject;
use App\Models\BusinessAnalytics;
use App\Models\BusinessTax;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoicePaymentMail;
use App\Models\ContactHistory;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Business\SmsTwilioController;
use App\Models\BusinessCredit;
use App\Services\BusinessCreditService;

class InvoiceController extends Controller
{
    public function index()
    {
        $query = BusinessInvoice::with(['client', 'projects'])
            ->latest();

        // Apply filters
        if (request()->has('status') && request('status') != '') {
            $query->where('status', request('status'));
        }

        if (request()->has('search') && request('search') != '') {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhereHas('client', function($q) use ($search) {
                      $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                  });
            });
        }

        if (request()->has('user_id') && request('user_id') != '') {
            $query->where('client_id', request('user_id'));
        }
        if (request()->has('invoice_date') && request('invoice_date') != '') {
            $query->whereDate('invoice_date', '>=', request('invoice_date'));
        }

        if (request()->has('date_to') && request('date_to') != '') {
            $query->whereDate('invoice_date', '<=', request('date_to'));
        }

        $invoices = $query->paginate(10);
        $clients = BusinessClient::all();
        $projects = BusinessProject::all();

        return view('default.panel.business.invoices.index', compact('invoices', 'clients', 'projects'));
    }
    public function show(BusinessInvoice $invoice)
    {
        $invoice->load(['client', 'projects', 'taxes']);
        return view('default.panel.business.invoices.show', compact('invoice'));
    }
    
    public function downloadPdf(BusinessInvoice $invoice)
    {
        $invoice->load(['client', 'projects', 'taxes']);
        
        // Ensure dates are properly parsed
        $invoice->invoice_date = \Carbon\Carbon::parse($invoice->invoice_date);
        $invoice->due_date = $invoice->due_date ? \Carbon\Carbon::parse($invoice->due_date) : null;
        
        $pdf = PDF::loadView('default.panel.business.invoices.pdf', compact('invoice'));
        return $pdf->download('invoice-'.$invoice->invoice_number.'.pdf');
    }
    public function create()
    {
        $clients = BusinessClient::all();
        $projects = BusinessProject::all();
        $taxes = BusinessTax::all();
        return view('default.panel.business.invoices.create', compact('clients', 'projects', 'taxes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_date' => 'required|date',
            'due_date' => 'required|date',
            'client_id' => 'required|exists:business_clients,id',
            'project_id' => 'required|array',
            'project_id.*' => 'exists:business_projects,id',
            'tax_id' => 'required|array',
            'tax_id.*' => 'exists:business_taxes,id',
            'status' => 'required|in:draft,sent,paid,cancelled',
            'description' => 'required|string',
            'send_email_notification' => 'required|boolean',
            'items' => 'required|array|min:1',
            'items.*.item_name' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $totalAmount = 0;
        foreach ($validated['items'] as $item) {
            $totalAmount += $item['quantity'] * $item['unit_price'];
        }

        // Check and consume invoice credit
        $user = auth()->user();
        if (!BusinessCreditService::hasCredits($user, 'invoices')) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'You have no invoice credits left. Please upgrade your plan.']);
        }
        
        if (!BusinessCreditService::consumeCredits($user, 'invoices')) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'Failed to consume invoice credit. Please try again.']);
        }

        $invoice = BusinessInvoice::create([
            'invoice_date' => $validated['invoice_date'],
            'due_date' => $validated['due_date'],
            'client_id' => $validated['client_id'],
            'amount' => $totalAmount,
            'status' => $validated['status'],
            'description' => $validated['description'] ?? null,
            'send_email_notification' => $request->has('send_notification'),
        ]);
        $userId = auth()->user()->id;
        $existingRecord = BusinessAnalytics::where('user_id', $userId)->first();
        
        if ($existingRecord) {
            // Update existing income by adding the new amount
            $existingRecord->income += $totalAmount;
            $existingRecord->save();
        } else {
            // Create new record
            BusinessAnalytics::create([
                'user_id' => $userId,
                'income' => $totalAmount,
            ]);
        }

        foreach ($validated['items'] as $item) {
            $invoice->items()->create([
                'item_name' => $item['item_name'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'subtotal' => $item['quantity'] * $item['unit_price'],
            ]);
        }

        // Sync projects if provided
        if (isset($validated['project_id'])) {
            $invoice->projects()->sync($validated['project_id']);
        }

        // Sync taxes if provided
        if (isset($validated['tax_id'])) {
            $invoice->taxes()->sync($validated['tax_id']);
        }

        // Calculate final amount including taxes for Stripe
        $taxAmount = 0;
        if (isset($validated['tax_id'])) {
            $invoice->load('taxes'); // Ensure taxes are loaded
            foreach ($invoice->taxes as $tax) {
                $taxAmount += ($invoice->amount * $tax->rate) / 100;
            }
        }
        $finalAmountForStripe = $totalAmount + $taxAmount;

        // Generate Stripe checkout session and save link
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Invoice #' . $invoice->id,
                    ],
                    'unit_amount' => (int)($finalAmountForStripe * 100), // Cast to integer
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('dashboard.business.invoices.payment.success', $invoice->id),
            'cancel_url' => route('dashboard.business.invoices.payment.cancel', $invoice->id),
        ]);

        $invoice->update(['payment_link' => $session->url]);

        // Send SMS notification for invoice creation
        $client = BusinessClient::find($validated['client_id']);
        if ($client && $client->mobile) {
            try {
                $message = $this->generateInvoiceCreationSMS($invoice, $client);
                app(\App\Http\Controllers\Business\SmsTwilioController::class)->sendCustomSms($client->mobile, $message);
            } catch (\Exception $e) {
                \Log::error("Invoice creation SMS failed for client {$client->id}: " . $e->getMessage());
            }
        }

        // Send email notification if checked
        if ($request->has('send_notification')) {
            // Reload the invoice to get the latest payment_link
            $invoice->fresh();
            try {
                Mail::to($invoice->client->email)->send(new InvoicePaymentMail($invoice));
            } catch (\Exception $e) {
                \Log::error("Invoice payment email failed for client {$invoice->client->id}: " . $e->getMessage());
            }
        }

        ContactHistory::create([
            'user_id' => Auth::id(),
            'action_type' => 'invoice_create',
            'reference_id' => $invoice->id,
            'reference_type' => 'BusinessInvoice',
            'description' => 'Created invoice: #' . $invoice->id,
        ]);

        // Redirect to invoice index page after creation
        return redirect()->route('dashboard.business.invoices.index')
            ->with(['type' => 'success', 'message' => 'Invoice created successfully and payment link generated!']);
    }

    public function edit(BusinessInvoice $invoice)
    {
        $clients = BusinessClient::all();
        $projects = BusinessProject::all();
        $taxes = BusinessTax::all();
        
        // Load the relationships
        $invoice->load(['projects', 'taxes']);
        
        // Get the selected project IDs
        $selectedProjects = $invoice->projects->pluck('id')->toArray();
        
        // Get the selected tax IDs
        $selectedTaxes = $invoice->taxes->pluck('id')->toArray();
        
        return view('default.panel.business.invoices.create', [
            'invoice' => $invoice,
            'clients' => $clients,
            'projects' => $projects,
            'taxes' => $taxes,
            'selectedProjects' => $selectedProjects,
            'selectedTaxes' => $selectedTaxes
        ]);
    }
    public function update(Request $request, BusinessInvoice $invoice)
    {
        $validated = $request->validate([
            'invoice_date' => 'required|date',
            'due_date' => 'nullable|date',
            'client_id' => 'required|exists:business_clients,id',
            'project_id' => 'nullable|array',
            'project_id.*' => 'exists:business_projects,id',
            'tax_id' => 'nullable|array',
            'tax_id.*' => 'exists:business_taxes,id',
            'status' => 'required|in:draft,sent,paid,cancelled',
            'description' => 'nullable|string',
            'send_email_notification' => 'nullable|boolean',
            'items' => 'required|array|min:1',
            'items.*.id' => 'nullable|exists:business_invoice_items,id',
            'items.*.item_name' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $totalAmount = 0;
        $existingItemIds = [];
        foreach ($validated['items'] as $item) {
            $totalAmount += $item['quantity'] * $item['unit_price'];
            if (isset($item['id'])) {
                $existingItemIds[] = $item['id'];
            }
        }

        $invoice->update([
            'invoice_date' => $validated['invoice_date'],
            'due_date' => $validated['due_date'],
            'client_id' => $validated['client_id'],
            'amount' => $totalAmount,
            'status' => $validated['status'],
            'description' => $validated['description'] ?? null,
            'send_email_notification' => $request->has('send_notification'),
        ]);

        // Delete items that are no longer present
        $invoice->items()->whereNotIn('id', $existingItemIds)->delete();

        // Create or update items
        foreach ($validated['items'] as $item) {
            $itemData = [
                'item_name' => $item['item_name'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'subtotal' => $item['quantity'] * $item['unit_price'],
            ];
            if (isset($item['id'])) {
                $invoice->items()->where('id', $item['id'])->update($itemData);
            } else {
                $invoice->items()->create($itemData);
            }
        }

        // Sync projects (empty array if none selected)
        $invoice->projects()->sync($validated['project_id'] ?? []);

        // Sync taxes (empty array if none selected)
        $invoice->taxes()->sync($validated['tax_id'] ?? []);
        
        ContactHistory::create([
            'user_id' => Auth::id(),
            'action_type' => 'invoice_update',
            'reference_id' => $invoice->id,
            'reference_type' => 'BusinessInvoice',
            'description' => 'Updated invoice: #' . $invoice->id,
        ]);

        return redirect()->route('dashboard.business.invoices.index')
            ->with('success', 'Invoice updated successfully.');
    }

    public function destroy(BusinessInvoice $invoice)
    {
        // We don't return credits when items are deleted
        // No need to check or manipulate credits here
        
        ContactHistory::create([
            'user_id' => Auth::id(),
            'action_type' => 'invoice_delete',
            'reference_id' => $invoice->id,
            'reference_type' => 'BusinessInvoice',
            'description' => 'Deleted invoice: #' . $invoice->id,
        ]);
        
        $invoice->projects()->detach();
        $invoice->taxes()->detach();
        $invoice->delete();

        return redirect()->route('dashboard.business.invoices.index')
            ->with('success', 'Invoice deleted successfully.');
    }

public function checkout(BusinessInvoice $invoice)
{
    Stripe::setApiKey(config('services.stripe.secret'));

    // Calculate total amount including taxes
    $taxAmount = 0;
    foreach ($invoice->taxes as $tax) {
        $taxAmount += ($invoice->amount * $tax->rate) / 100;
    }
    $totalAmountWithTaxes = $invoice->amount + $taxAmount;

    $session = StripeSession::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => 'Invoice #' . $invoice->id,
                ],
                'unit_amount' => $totalAmountWithTaxes * 100, // amount in cents
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => route('dashboard.business.invoices.payment.success', $invoice->id),
        'cancel_url' => route('dashboard.business.invoices.payment.cancel', $invoice->id),
    ]);

    return redirect($session->url);
}
public function paymentSuccess(BusinessInvoice $invoice)
{
    $invoice->update(['status' => BusinessInvoice::STATUS_PAID]);

    // Send SMS notification for successful payment
    $client = $invoice->client; // Assuming a direct client relationship on invoice
    if ($client && $client->mobile) {
        try {
            $message = $this->generatePaymentSuccessSMS($invoice, $client);
            app(\App\Http\Controllers\Business\SmsTwilioController::class)->sendCustomSms($client->mobile, $message);
        } catch (\Exception $e) {
            \Log::error("Payment success SMS failed for client {$client->id}: " . $e->getMessage());
        }
    }

    return redirect()->route('dashboard.business.invoices.show', $invoice)->with('success', 'Payment successful!');
}

public function paymentCancel(BusinessInvoice $invoice)
{
    return redirect()->route('dashboard.business.invoices.show', $invoice)->with('error', 'Payment cancelled.');
}
public function bulkdelete(Request $request)
    {
        // We don't return credits when items are deleted
        // No need to check or manipulate credits here
        $ids = $request->input('ids');
        BusinessInvoice::whereIn('id', $ids)->delete();
    
        return response()->json(['success' => true]);
    }
public function getInvoiceData($id): JsonResponse
{
    try {
        $invoice = BusinessInvoice::findOrFail($id);
        $items = BusinessInvoiceItem::where('invoice_id', $id)->get();

        return response()->json([
            'invoice' => $invoice,
            'items' => $items,
        ], 200);
    } catch (\Exception $e) {
        Log::error('Failed to fetch invoice data', [
            'invoice_id' => $id,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        return response()->json([
            'message' => 'Failed to retrieve invoice data. Please try again later.',
        ], 500);
    }
}

public function getinvoicesdata(Request $request)
{
    // dd('in');
    try {
        $query = BusinessInvoice::with(['client', 'taxes']);
    //    $data = $query->get(); // <-- This actually runs the query
 
    //     dd($data);
        return DataTables::of($query)
            ->addColumn('checkbox', function($row) {
                return ''; // Checkbox handled in JS
            })
           
            ->addColumn('client_id', function($row) {
                return $row->id ? $row->id : '';
            })
         ->addColumn('client_name', function($row) {
                return $row->client ? ($row->client->first_name . ' ' . $row->client->last_name) : '—';
            })
            ->addColumn('actions', function($row) {
                return ''; // Actions handled in JS
            })
            ->editColumn('invoice_date', function($row) {
                return $row->invoice_date ? Carbon::parse($row->invoice_date)->format('Y-m-d') : '';
            })
           ->editColumn('due_date', function($row) {
                return $row->due_date ? Carbon::parse($row->due_date)->format('Y-m-d') : '';
            })
            ->addColumn('amount', function($row) {
                $totalAmount = $row->amount;
                foreach ($row->taxes as $tax) {
                    $totalAmount += ($row->amount * $tax->rate) / 100;
                }
                return number_format($totalAmount, 2); // Format to 2 decimal places
            })
            ->editColumn('status', function($row) {
                return $row->status;
            })
            ->rawColumns(['checkbox', 'actions'])
            ->make(true);
 
    } catch (\Exception $e) {
        return response()->json([
            'error' => true,
            'message' => $e->getMessage()
        ], 500); // return proper error response
    }
}

    protected function generateInvoiceCreationSMS($invoice, $client)
    {
        // Ensure taxes are loaded on the invoice
        $invoice->loadMissing('taxes');

        $totalAmountWithTaxes = $invoice->amount;
        foreach ($invoice->taxes as $tax) {
            $totalAmountWithTaxes += ($invoice->amount * $tax->rate) / 100;
        }

        return sprintf(
            "Hello %s, your invoice for %s%.2f is ready. You can view and pay through email link.",
            $client->first_name,
            $invoice->currency,
            $totalAmountWithTaxes
        );
    }

    protected function generatePaymentSuccessSMS($invoice, $client)
    {
        // Ensure taxes are loaded on the invoice
        $invoice->loadMissing('taxes');

        $totalAmountWithTaxes = $invoice->amount;
        foreach ($invoice->taxes as $tax) {
            $totalAmountWithTaxes += ($invoice->amount * $tax->rate) / 100;
        }

        return sprintf(
            "Hello %s, your payment of %s%.2f has been successfully received. Thank you!",
            $client->first_name,
            $invoice->currency,
            $totalAmountWithTaxes
        );
    }
}
=======
<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessInvoice;
use App\Models\BusinessInvoiceItem;
use App\Models\BusinessClient;
use App\Models\BusinessProject;
use App\Models\BusinessAnalytics;
use App\Models\BusinessTax;
use Stripe\Stripe;
use Stripe\Checkout\Session as StripeSession;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\JsonResponse;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoicePaymentMail;
use App\Models\ContactHistory;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Business\SmsTwilioController;
use App\Models\BusinessCredit;
use App\Services\BusinessCreditService;

class InvoiceController extends Controller
{
    public function index()
    {
        $query = BusinessInvoice::with(['client', 'projects'])
            ->latest();

        // Apply filters
        if (request()->has('status') && request('status') != '') {
            $query->where('status', request('status'));
        }

        if (request()->has('search') && request('search') != '') {
            $search = request('search');
            $query->where(function($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhereHas('client', function($q) use ($search) {
                      $q->where('first_name', 'like', "%{$search}%")
                        ->orWhere('last_name', 'like', "%{$search}%");
                  });
            });
        }

        if (request()->has('user_id') && request('user_id') != '') {
            $query->where('client_id', request('user_id'));
        }
        if (request()->has('invoice_date') && request('invoice_date') != '') {
            $query->whereDate('invoice_date', '>=', request('invoice_date'));
        }

        if (request()->has('date_to') && request('date_to') != '') {
            $query->whereDate('invoice_date', '<=', request('date_to'));
        }

        $invoices = $query->paginate(10);
        $clients = BusinessClient::all();
        $projects = BusinessProject::all();

        return view('default.panel.business.invoices.index', compact('invoices', 'clients', 'projects'));
    }
    public function show(BusinessInvoice $invoice)
    {
        $invoice->load(['client', 'projects', 'taxes']);
        return view('default.panel.business.invoices.show', compact('invoice'));
    }
    
    public function downloadPdf(BusinessInvoice $invoice)
    {
        $invoice->load(['client', 'projects', 'taxes']);
        
        // Ensure dates are properly parsed
        $invoice->invoice_date = \Carbon\Carbon::parse($invoice->invoice_date);
        $invoice->due_date = $invoice->due_date ? \Carbon\Carbon::parse($invoice->due_date) : null;
        
        $pdf = PDF::loadView('default.panel.business.invoices.pdf', compact('invoice'));
        return $pdf->download('invoice-'.$invoice->invoice_number.'.pdf');
    }
    public function create()
    {
        $clients = BusinessClient::all();
        $projects = BusinessProject::all();
        $taxes = BusinessTax::all();
        return view('default.panel.business.invoices.create', compact('clients', 'projects', 'taxes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_date' => 'required|date',
            'due_date' => 'required|date',
            'client_id' => 'required|exists:business_clients,id',
            'project_id' => 'required|array',
            'project_id.*' => 'exists:business_projects,id',
            'tax_id' => 'required|array',
            'tax_id.*' => 'exists:business_taxes,id',
            'status' => 'required|in:draft,sent,paid,cancelled',
            'description' => 'required|string',
            'send_email_notification' => 'required|boolean',
            'items' => 'required|array|min:1',
            'items.*.item_name' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $totalAmount = 0;
        foreach ($validated['items'] as $item) {
            $totalAmount += $item['quantity'] * $item['unit_price'];
        }

        // Check and consume invoice credit
        $user = auth()->user();
        if (!BusinessCreditService::hasCredits($user, 'invoices')) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'You have no invoice credits left. Please upgrade your plan.']);
        }
        
        if (!BusinessCreditService::consumeCredits($user, 'invoices')) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'Failed to consume invoice credit. Please try again.']);
        }

        $invoice = BusinessInvoice::create([
            'invoice_date' => $validated['invoice_date'],
            'due_date' => $validated['due_date'],
            'client_id' => $validated['client_id'],
            'amount' => $totalAmount,
            'status' => $validated['status'],
            'description' => $validated['description'] ?? null,
            'send_email_notification' => $request->has('send_notification'),
        ]);
        $userId = auth()->user()->id;
        $existingRecord = BusinessAnalytics::where('user_id', $userId)->first();
        
        if ($existingRecord) {
            // Update existing income by adding the new amount
            $existingRecord->income += $totalAmount;
            $existingRecord->save();
        } else {
            // Create new record
            BusinessAnalytics::create([
                'user_id' => $userId,
                'income' => $totalAmount,
            ]);
        }

        foreach ($validated['items'] as $item) {
            $invoice->items()->create([
                'item_name' => $item['item_name'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'subtotal' => $item['quantity'] * $item['unit_price'],
            ]);
        }

        // Sync projects if provided
        if (isset($validated['project_id'])) {
            $invoice->projects()->sync($validated['project_id']);
        }

        // Sync taxes if provided
        if (isset($validated['tax_id'])) {
            $invoice->taxes()->sync($validated['tax_id']);
        }

        // Calculate final amount including taxes for Stripe
        $taxAmount = 0;
        if (isset($validated['tax_id'])) {
            $invoice->load('taxes'); // Ensure taxes are loaded
            foreach ($invoice->taxes as $tax) {
                $taxAmount += ($invoice->amount * $tax->rate) / 100;
            }
        }
        $finalAmountForStripe = $totalAmount + $taxAmount;

        // Generate Stripe checkout session and save link
        Stripe::setApiKey(config('services.stripe.secret'));

        $session = StripeSession::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Invoice #' . $invoice->id,
                    ],
                    'unit_amount' => (int)($finalAmountForStripe * 100), // Cast to integer
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('dashboard.business.invoices.payment.success', $invoice->id),
            'cancel_url' => route('dashboard.business.invoices.payment.cancel', $invoice->id),
        ]);

        $invoice->update(['payment_link' => $session->url]);

        // Send SMS notification for invoice creation
        $client = BusinessClient::find($validated['client_id']);
        if ($client && $client->mobile) {
            try {
                $message = $this->generateInvoiceCreationSMS($invoice, $client);
                app(\App\Http\Controllers\Business\SmsTwilioController::class)->sendCustomSms($client->mobile, $message);
            } catch (\Exception $e) {
                \Log::error("Invoice creation SMS failed for client {$client->id}: " . $e->getMessage());
            }
        }

        // Send email notification if checked
        if ($request->has('send_notification')) {
            // Reload the invoice to get the latest payment_link
            $invoice->fresh();
            try {
                Mail::to($invoice->client->email)->send(new InvoicePaymentMail($invoice));
            } catch (\Exception $e) {
                \Log::error("Invoice payment email failed for client {$invoice->client->id}: " . $e->getMessage());
            }
        }

        ContactHistory::create([
            'user_id' => Auth::id(),
            'action_type' => 'invoice_create',
            'reference_id' => $invoice->id,
            'reference_type' => 'BusinessInvoice',
            'description' => 'Created invoice: #' . $invoice->id,
        ]);

        // Redirect to invoice index page after creation
        return redirect()->route('dashboard.business.invoices.index')
            ->with(['type' => 'success', 'message' => 'Invoice created successfully and payment link generated!']);
    }

    public function edit(BusinessInvoice $invoice)
    {
        $clients = BusinessClient::all();
        $projects = BusinessProject::all();
        $taxes = BusinessTax::all();
        
        // Load the relationships
        $invoice->load(['projects', 'taxes']);
        
        // Get the selected project IDs
        $selectedProjects = $invoice->projects->pluck('id')->toArray();
        
        // Get the selected tax IDs
        $selectedTaxes = $invoice->taxes->pluck('id')->toArray();
        
        return view('default.panel.business.invoices.create', [
            'invoice' => $invoice,
            'clients' => $clients,
            'projects' => $projects,
            'taxes' => $taxes,
            'selectedProjects' => $selectedProjects,
            'selectedTaxes' => $selectedTaxes
        ]);
    }
    public function update(Request $request, BusinessInvoice $invoice)
    {
        $validated = $request->validate([
            'invoice_date' => 'required|date',
            'due_date' => 'nullable|date',
            'client_id' => 'required|exists:business_clients,id',
            'project_id' => 'nullable|array',
            'project_id.*' => 'exists:business_projects,id',
            'tax_id' => 'nullable|array',
            'tax_id.*' => 'exists:business_taxes,id',
            'status' => 'required|in:draft,sent,paid,cancelled',
            'description' => 'nullable|string',
            'send_email_notification' => 'nullable|boolean',
            'items' => 'required|array|min:1',
            'items.*.id' => 'nullable|exists:business_invoice_items,id',
            'items.*.item_name' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric|min:0',
        ]);

        $totalAmount = 0;
        $existingItemIds = [];
        foreach ($validated['items'] as $item) {
            $totalAmount += $item['quantity'] * $item['unit_price'];
            if (isset($item['id'])) {
                $existingItemIds[] = $item['id'];
            }
        }

        $invoice->update([
            'invoice_date' => $validated['invoice_date'],
            'due_date' => $validated['due_date'],
            'client_id' => $validated['client_id'],
            'amount' => $totalAmount,
            'status' => $validated['status'],
            'description' => $validated['description'] ?? null,
            'send_email_notification' => $request->has('send_notification'),
        ]);

        // Delete items that are no longer present
        $invoice->items()->whereNotIn('id', $existingItemIds)->delete();

        // Create or update items
        foreach ($validated['items'] as $item) {
            $itemData = [
                'item_name' => $item['item_name'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'subtotal' => $item['quantity'] * $item['unit_price'],
            ];
            if (isset($item['id'])) {
                $invoice->items()->where('id', $item['id'])->update($itemData);
            } else {
                $invoice->items()->create($itemData);
            }
        }

        // Sync projects (empty array if none selected)
        $invoice->projects()->sync($validated['project_id'] ?? []);

        // Sync taxes (empty array if none selected)
        $invoice->taxes()->sync($validated['tax_id'] ?? []);
        
        ContactHistory::create([
            'user_id' => Auth::id(),
            'action_type' => 'invoice_update',
            'reference_id' => $invoice->id,
            'reference_type' => 'BusinessInvoice',
            'description' => 'Updated invoice: #' . $invoice->id,
        ]);

        return redirect()->route('dashboard.business.invoices.index')
            ->with('success', 'Invoice updated successfully.');
    }

    public function destroy(BusinessInvoice $invoice)
    {
        // We don't return credits when items are deleted
        // No need to check or manipulate credits here
        
        ContactHistory::create([
            'user_id' => Auth::id(),
            'action_type' => 'invoice_delete',
            'reference_id' => $invoice->id,
            'reference_type' => 'BusinessInvoice',
            'description' => 'Deleted invoice: #' . $invoice->id,
        ]);
        
        $invoice->projects()->detach();
        $invoice->taxes()->detach();
        $invoice->delete();

        return redirect()->route('dashboard.business.invoices.index')
            ->with('success', 'Invoice deleted successfully.');
    }

public function checkout(BusinessInvoice $invoice)
{
    Stripe::setApiKey(config('services.stripe.secret'));

    // Calculate total amount including taxes
    $taxAmount = 0;
    foreach ($invoice->taxes as $tax) {
        $taxAmount += ($invoice->amount * $tax->rate) / 100;
    }
    $totalAmountWithTaxes = $invoice->amount + $taxAmount;

    $session = StripeSession::create([
        'payment_method_types' => ['card'],
        'line_items' => [[
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => 'Invoice #' . $invoice->id,
                ],
                'unit_amount' => $totalAmountWithTaxes * 100, // amount in cents
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => route('dashboard.business.invoices.payment.success', $invoice->id),
        'cancel_url' => route('dashboard.business.invoices.payment.cancel', $invoice->id),
    ]);

    return redirect($session->url);
}
public function paymentSuccess(BusinessInvoice $invoice)
{
    $invoice->update(['status' => BusinessInvoice::STATUS_PAID]);

    // Send SMS notification for successful payment
    $client = $invoice->client; // Assuming a direct client relationship on invoice
    if ($client && $client->mobile) {
        try {
            $message = $this->generatePaymentSuccessSMS($invoice, $client);
            app(\App\Http\Controllers\Business\SmsTwilioController::class)->sendCustomSms($client->mobile, $message);
        } catch (\Exception $e) {
            \Log::error("Payment success SMS failed for client {$client->id}: " . $e->getMessage());
        }
    }

    return redirect()->route('dashboard.business.invoices.show', $invoice)->with('success', 'Payment successful!');
}

public function paymentCancel(BusinessInvoice $invoice)
{
    return redirect()->route('dashboard.business.invoices.show', $invoice)->with('error', 'Payment cancelled.');
}
public function bulkdelete(Request $request)
    {
        // We don't return credits when items are deleted
        // No need to check or manipulate credits here
        $ids = $request->input('ids');
        BusinessInvoice::whereIn('id', $ids)->delete();
    
        return response()->json(['success' => true]);
    }
public function getInvoiceData($id): JsonResponse
{
    try {
        $invoice = BusinessInvoice::findOrFail($id);
        $items = BusinessInvoiceItem::where('invoice_id', $id)->get();

        return response()->json([
            'invoice' => $invoice,
            'items' => $items,
        ], 200);
    } catch (\Exception $e) {
        Log::error('Failed to fetch invoice data', [
            'invoice_id' => $id,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        return response()->json([
            'message' => 'Failed to retrieve invoice data. Please try again later.',
        ], 500);
    }
}

public function getinvoicesdata(Request $request)
{
    // dd('in');
    try {
        $query = BusinessInvoice::with(['client', 'taxes']);
    //    $data = $query->get(); // <-- This actually runs the query
 
    //     dd($data);
        return DataTables::of($query)
            ->addColumn('checkbox', function($row) {
                return ''; // Checkbox handled in JS
            })
           
            ->addColumn('client_id', function($row) {
                return $row->id ? $row->id : '';
            })
         ->addColumn('client_name', function($row) {
                return $row->client ? ($row->client->first_name . ' ' . $row->client->last_name) : '—';
            })
            ->addColumn('actions', function($row) {
                return ''; // Actions handled in JS
            })
            ->editColumn('invoice_date', function($row) {
                return $row->invoice_date ? Carbon::parse($row->invoice_date)->format('Y-m-d') : '';
            })
           ->editColumn('due_date', function($row) {
                return $row->due_date ? Carbon::parse($row->due_date)->format('Y-m-d') : '';
            })
            ->addColumn('amount', function($row) {
                $totalAmount = $row->amount;
                foreach ($row->taxes as $tax) {
                    $totalAmount += ($row->amount * $tax->rate) / 100;
                }
                return number_format($totalAmount, 2); // Format to 2 decimal places
            })
            ->editColumn('status', function($row) {
                return $row->status;
            })
            ->rawColumns(['checkbox', 'actions'])
            ->make(true);
 
    } catch (\Exception $e) {
        return response()->json([
            'error' => true,
            'message' => $e->getMessage()
        ], 500); // return proper error response
    }
}

    protected function generateInvoiceCreationSMS($invoice, $client)
    {
        // Ensure taxes are loaded on the invoice
        $invoice->loadMissing('taxes');

        $totalAmountWithTaxes = $invoice->amount;
        foreach ($invoice->taxes as $tax) {
            $totalAmountWithTaxes += ($invoice->amount * $tax->rate) / 100;
        }

        return sprintf(
            "Hello %s, your invoice for %s%.2f is ready. You can view and pay through email link.",
            $client->first_name,
            $invoice->currency,
            $totalAmountWithTaxes
        );
    }

    protected function generatePaymentSuccessSMS($invoice, $client)
    {
        // Ensure taxes are loaded on the invoice
        $invoice->loadMissing('taxes');

        $totalAmountWithTaxes = $invoice->amount;
        foreach ($invoice->taxes as $tax) {
            $totalAmountWithTaxes += ($invoice->amount * $tax->rate) / 100;
        }

        return sprintf(
            "Hello %s, your payment of %s%.2f has been successfully received. Thank you!",
            $client->first_name,
            $invoice->currency,
            $totalAmountWithTaxes
        );
    }
}
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
