<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\BusinessBookingCalendly;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\BusinessClient;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Facades\DataTables;
class BusinessBookingCalendlyController extends Controller
{
    public function index()
    {

        $bookings = BusinessBookingCalendly::orderBy('start_time', 'desc')->paginate(10);
        $clients = BusinessClient::all();
        // dd($clients);
        return view('default.panel.business.calendly.index', compact('bookings', 'clients'));
    }
  public function registerCalendlyWebhook(Request $request)
    {
        $token = env('CALENDLY_API_KEY');
        $org = env('CALENDLY_ORGANIZATION_URI');
        $user = env('CALENDLY_USER_URI');
        $webhookUrl = 'https://5309-182-186-104-31.ngrok-free.app/api/calendly/webhook'; // Update this every time NGROK restarts!
        $response = Http::withOptions(['verify' => false])
            ->withToken($token)
            ->post('https://api.calendly.com/webhook_subscriptions', [
                'url' => $webhookUrl,
                'events' => ['invitee.created', 'invitee.canceled'],
                'organization' => $org,
                'user' => $user,
                'scope' => 'user'
            ]);

        return response()->json([
            'status' => $response->status(),
            'body' => $response->json()
        ]);
    }

    public function show(BusinessBookingCalendly $booking)
    {
        $booking->load('clients');
        return view('default.panel.business.calendly.show', compact('booking'));
    }

    // Add this new method to handle Calendly embed
    public function embed()
    {
        return view('default.panel.business.calendly.embed');
    }

    public function markaspaid(BusinessBookingCalendly $booking)
    {
        $booking->update(['payment_status' => 'paid']);
        return response()->json(['success' => true]);
    }

    public function markascompleted(BusinessBookingCalendly $booking)
    {
        $booking->update(['status' => 'completed']);
        return response()->json(['success' => true]);
    }

    public function cancel(BusinessBookingCalendly $booking)
    {
        // If the booking came from Calendly, we should redirect to their cancel URL
        if ($booking->cancel_url) {
            return redirect()->away($booking->cancel_url);
        }

        $booking->update([
            'status' => 'canceled',
            'canceled_at' => now(),
            'canceler_name' => auth()->user()->name ?? 'System'
        ]);

        return back()->with('success', 'Booking canceled successfully');
    }

    public function reschedule(BusinessBookingCalendly $booking)
    {
        // If the booking came from Calendly, redirect to their reschedule URL
        if ($booking->reschedule_url) {
            return redirect()->away($booking->reschedule_url);
        }

        // Your custom reschedule logic here
        return view('default.panel.business.calendly.reschedule', compact('booking'));
    }

    // Update other methods as needed...
    public function getcalendlydata(Request $request)
{
    // dd($request->status);
    try {
        $query = BusinessBookingCalendly::query()->latest();
 
        // Optional filters
        if ($request->filled('client')) {
            $query->where('invitee_email', BusinessClient::find($request->client)->email ?? '---');
        }
 
        if ($request->filled('status')) {
            $query->where('payment_status', $request->status);
        }
         if ($request->filled('date_from')) {
            $query->where('start_time', $request->date_from);
        }
        if ($request->filled('date_to')) {
            $query->where('end_time', $request->date_to);
        }
       
 
        return DataTables::of($query)
            ->addColumn('checkbox', function ($row) {
                return '<input type="checkbox" class="booking-checkbox" value="' . $row->id . '">';
            })
            ->addColumn('client_info', function ($row) {
                return '
                    <div class="flex items-center">
                        <div>
                            <div class="font-medium">' . e($row->invitee_name) . '</div>
                            <div class="text-xs text-gray-500">' . e($row->invitee_email) . '</div>
                        </div>
                    </div>
                ';
            })
            ->addColumn('event_type', function ($row) {
                return e($row->event_type);
            })
            ->addColumn('date', function ($row) {
                return optional($row->start_time)->format('M d, Y');
            })
            ->addColumn('time', function ($row) {
                return optional($row->start_time)->format('h:i A') . ' - ' . optional($row->end_time)->format('h:i A');
            })
            ->addColumn('status', function ($row) {
                switch ($row->status) {
                    case 'scheduled':
                        return '<span class="badge badge-scheduled">Scheduled</span>';
                    case 'confirmed':
                    case 'active':
                        return '<span class="badge badge-confirmed">Confirmed</span>';
                    case 'completed':
                        return '<span class="badge badge-completed">Completed</span>';
                    case 'canceled':
                        return '<span class="badge badge-cancelled">Canceled</span>';
                    default:
                        return '<span class="badge">' . e($row->status) . '</span>';
                }
            })
            ->addColumn('payment', function ($row) {
                return $row->payment_status === 'paid'
                    ? '<span class="badge badge-paid">Paid</span>'
                    : '<span class="badge badge-unpaid">Unpaid</span>';
            })
            ->addColumn('actions', function ($row) {
                $actions = '<div class="actions">';
                $actions .= '<a href="' . route('dashboard.business.calendly.show', $row->id) . '" class="action-btn" title="View"><i class="fa-solid fa-eye fa-2xs"></i></a>';
 
                if ($row->status !== 'completed') {
                    $actions .= '<form action="' . route('dashboard.business.calendly.markascompleted', $row->id) . '" method="POST" class="inline-form">'
                        . csrf_field()
                        . '<button type="submit" class="action-btn" title="Mark as Completed"><i class="fa-solid fa-check-circle fa-2xs"></i></button></form>';
                }
 
                if ($row->payment_status !== 'paid') {
                    $actions .= '<form action="' . route('dashboard.business.calendly.markaspaid', $row->id) . '" method="POST" class="inline-form">'
                        . csrf_field()
                        . '<button type="submit" class="action-btn" title="Mark as Paid"><i class="fa-solid fa-dollar-sign fa-2xs"></i></button></form>';
                }
 
                if ($row->status !== 'canceled') {
                    $actions .= '<form action="' . route('dashboard.business.calendly.cancel', $row->id) . '" method="POST" class="inline-form">'
                        . csrf_field()
                        . '<button type="submit" class="action-btn" title="Cancel"><i class="fa-solid fa-ban fa-2xs"></i></button></form>';
                }
 
                if (!empty($row->reschedule_url)) {
                    $actions .= '<a href="' . $row->reschedule_url . '" class="action-btn" title="Reschedule" target="_blank">'
                        . '<i class="fa-solid fa-calendar-arrow-up fa-2xs"></i></a>';
                }
 
                $actions .= '</div>';
                return $actions;
            })
            ->rawColumns(['checkbox', 'client_info', 'status', 'payment', 'actions'])
            ->make(true);
    } catch (\Exception $e) {
        return response()->json([
            'error' => true,
            'message' => $e->getMessage()
        ], 500); // return proper error response
    }
}


 public function bulkAction(Request $request)
    {
        dd('in');
        try {
            $ids = $request->ids;
            
            if (empty($ids)) {
                return response()->json([
                    'success' => false,
                    'message' => 'No taxes selected'
                ]);
            }

            BusinessTax::whereIn('id', $ids)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Selected taxes deleted successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Bulk tax delete error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete taxes'
            ], 500);
        }
    }
}