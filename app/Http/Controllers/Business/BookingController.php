<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use App\Models\BusinessBooking;
use App\Models\BusinessClient;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\BookingConfirmation;

class BookingController extends Controller
{
public function index()
{
    $bookings = BusinessBooking::query()
        ->with(['user', 'clients'])
        ->when(request('status'), function($query, $status) {
            return $query->where('status', $status);
        })
        ->when(request('client_id'), function($query, $clientId) {
            return $query->whereHas('clients', function($q) use ($clientId) {
                $q->where('business_clients.id', $clientId);
            });
        })
        ->when(request('date_from'), function($query, $date) {
            return $query->whereDate('start_time', '>=', $date);
        })
        ->when(request('date_to'), function($query, $date) {
            return $query->whereDate('start_time', '<=', $date);
        })
        ->when(request('search'), function($query, $search) {
            return $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('id', $search)
                    ->orWhereHas('user', function($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('clients', function($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            });
        })
        ->latest()
        ->paginate(10);

    $clients = BusinessClient::all();

    return view('default.panel.business.booking.index', compact('bookings', 'clients'));
    }    
    // Show create form
    public function create()
    {
        $clients = BusinessClient::all();
        return view('default.panel.business.booking.create', compact('clients'));
    }

    // Store new booking
    public function store(Request $request)
    {
        dd($request->all());
        $validated = $request->validate([
            'user_id' => 'required|exists:business_clients,id',
            'title' => 'required|string|max:255',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'timezone' => 'required|string|max:100',
            'meeting_link' => 'nullable|url',
            'calendly_event_id' => 'required|string', // if you want to store this
            'invitee_email' => 'required|email', // use this to find/create client
            'invitee_name' => 'nullable|string',
        ]);
        $booking = BusinessBooking::create([
            'user_id' => $validated['user_id'],
            'title' => $validated['title'],
            'start_time' => $validated['start_time'],
            'end_time' => $validated['end_time'],
            'timezone' => $validated['timezone'],
            'meeting_link' => $validated['meeting_link'],
            'status' => 'confirmed',
            'description' => 'Booked via Calendly',
            'calendly_event_id' => $validated['calendly_event_id'],
        ]);
        
        // Attach the client
        $booking->clients()->attach($client->id);
        
        // Send confirmation
        // Mail::to($client->email)->send(new BookingConfirmation($booking, $client));

        return redirect()->route('dashboard.business.bookings.index')->with('success', 'Booking created and notifications sent!');
    }

    // Show one booking
    public function show(BusinessBooking $booking)
    {
        $booking->load('clients', 'user');
        return view('default.panel.business.booking.show', compact('booking'));
    }

    // Show edit form
    public function edit($id)
    {
        $booking = BusinessBooking::with('clients')->findOrFail($id);
        $clients = BusinessClient::all();
        return view('default.panel.business.booking.create', compact('booking', 'clients'));
    }
    
    // Update booking
    public function update(Request $request, BusinessBooking $booking)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:business_clients,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'required|date',
            'end_time' => 'required|date|after:start_time',
            'timezone' => 'required|string|max:100',
            'status' => 'required|in:pending,confirmed,cancelled',
            'meeting_link' => 'nullable|url',
            'client_ids' => 'required|array',
            'client_ids.*' => 'exists:business_clients,id',
        ]);

        // Update booking
        $booking->update($validated);

        // Sync clients
        $booking->clients()->sync($validated['client_ids']);

        return redirect()->route('dashboard.business.bookings.index')->with('success', 'Booking updated!');
    }

    // Delete booking
    public function destroy(BusinessBooking $booking)
    {
        $booking->delete();
        return redirect()->route('dashboard.business.bookings.index')->with('success', 'Booking deleted!');
    }
}
