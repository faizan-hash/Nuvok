<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BusinessClient;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Mail;
use App\Mail\ClientWelcomeEmail; // Add this for the Mailable class
use App\Http\Controllers\business\SmsTwilioController; // Add this for SMS
use App\Models\ContactHistory;
use Illuminate\Support\Facades\Auth;
use App\Models\BusinessCredit;
use App\Services\BusinessCreditService;

class ClientController extends Controller
{
     public function index()
    {
        $companies = BusinessClient::distinct()->pluck('company_name');
        $industries = BusinessClient::distinct()->whereNotNull('industry')->pluck('industry');
        $countries = BusinessClient::distinct()->whereNotNull('country')->pluck('country');
        return view('default.panel.business.clients.index', compact('companies', 'industries', 'countries'));
    }

    public function datatable(Request $request)
    {
        $query = BusinessClient::query();

        // Apply filters
        if ($request->filled('company')) {
            $query->where('company_name', $request->company);
        }

        if ($request->filled('id_number')) {
            $query->where('id_number', 'like', '%' . $request->id_number . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('phone')) {
            $query->where('mobile', 'like', '%' . $request->phone . '%');
        }

        if ($request->filled('industry')) {
            $query->where('industry', $request->industry);
        }

        if ($request->filled('country')) {
            $query->where('country', $request->country);
        }

        return DataTables::of($query)
            ->addColumn('checkbox', function($client) {
                return '';
            })
            ->addColumn('name', function($client) {
                return [
                    'first_name' => $client->first_name,
                    'last_name' => $client->last_name,
                    'full_name' => $client->first_name . ' ' . $client->last_name,
                    'avatar' => $client->avatar
                ];
            })
            ->addColumn('actions', function($client) {
                return '';
            })
            ->rawColumns(['checkbox', 'actions'])
            ->make(true);
    }

    public function bulkAction(Request $request)
    {
        try {
            $ids = $request->ids;
            
            if (empty($ids)) {
                return response()->json([
                    'success' => false,
                    'message' => 'No clients selected'
                ]);
            }

            // We don't return credits when items are deleted
            // No need to check or manipulate credits here
            BusinessClient::whereIn('id', $ids)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Selected clients deleted successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete clients'
            ], 500);
        }
    }

    public function create()
    {
        return view('default.panel.business.clients.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateRequest($request);
        
        // Check and consume client credit
        $user = auth()->user();
        if (!BusinessCreditService::hasCredits($user, 'clients')) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'You have no client credits left. Please upgrade your plan.']);
        }
        
        if (!BusinessCreditService::consumeCredits($user, 'clients')) {
            return redirect()->back()->with(['type' => 'error', 'message' => 'Failed to consume client credit. Please try again.']);
        }

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }
        $plainPassword = $validated['password'];
        $validated['password'] = Hash::make($validated['password']);

        $client = BusinessClient::create($validated);
        // ContactHistory log
        ContactHistory::create([
            'user_id' => Auth::id(),
            'action_type' => 'client_create',
            'reference_id' => $client->id,
            'reference_type' => 'BusinessClient',
            'description' => 'Created client: ' . $client->first_name . ' ' . $client->last_name,
        ]);

        // Credit was already consumed above

        try {
            Mail::to($client->email)->send(
                new ClientWelcomeEmail($client, $plainPassword) // Pass the plain password
            );
        } catch (\Exception $e) {
            \Log::error("Welcome email failed: " . $e->getMessage());
        }
        // Send welcome SMS
        if (!empty($client->mobile)) {
            try {
                $message = "Welcome {$client->first_name}! Thank you for registering with us.";
                app(SmsTwilioController::class)->sendCustomSms(
                    $client->mobile,
                    $message
                );
            } catch (\Exception $e) {
                \Log::error("Welcome SMS failed for client {$client->id}: " . $e->getMessage());
            }
        }
        
        
            return redirect()->route('dashboard.business.clients.index')
                            ->with(['type' => 'success', 'message' => 'Client created successfully!']);
    }
    public function edit(BusinessClient $client)
    {
        return view('default.panel.business.clients.create', compact('client'));
    }

    public function update(Request $request, BusinessClient $client)
    {
        $validated = $this->validateRequest($request, $client->id);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $client->update($validated);
        
        ContactHistory::create([
            'user_id' => Auth::id(),
            'action_type' => 'client_update',
            'reference_id' => $client->id,
            'reference_type' => 'BusinessClient',
            'description' => 'Updated client: ' . $client->first_name . ' ' . $client->last_name,
        ]);

        return redirect()->route('dashboard.business.clients.index')
                         ->with(['type' => 'success', 'message' => 'Client updated successfully!']);
    }

    public function destroy(BusinessClient $client)
    {
        // We don't return credits when items are deleted
        // No need to check or manipulate credits here

        // ContactHistory log
        ContactHistory::create([
            'user_id' => Auth::id(),
            'action_type' => 'client_delete',
            'reference_id' => $client->id,
            'reference_type' => 'BusinessClient',
            'description' => 'Deleted client: ' . $client->first_name . ' ' . $client->last_name,
        ]);
        
        $client->delete();
        return redirect()->route('dashboard.business.clients.index')
                         ->with(['type' => 'success', 'message' => 'Client deleted successfully!']);
    }

    protected function validateRequest(Request $request, $clientId = null)
    {
        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'id_number' => 'required|string|max:255|unique:business_clients,id_number,'.$clientId,
            'company_name' => 'required|string|max:255',
            'email' => 'required|email|unique:business_clients,email,'.$clientId,
            'mobile' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'job_type' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'industry' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
        ];

        // Only require password for new clients or when changing password
        if (!$clientId || $request->filled('password')) {
            $rules['password'] = 'required|string|min:8|confirmed';
        }

        return $request->validate($rules);
    }
}