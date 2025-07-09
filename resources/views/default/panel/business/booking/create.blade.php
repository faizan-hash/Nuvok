@use(\App\Domains\Entity\Enums\EntityEnum)
@extends('panel.layout.settings', ['layout' => 'fullwidth'])

@section('title', __('Schedule Booking via Calendly'))
@section('titlebar_actions', '')

@section('additional_css')
    <link href="{{ asset('bussiness/custom-create.css') }}" rel="stylesheet" />
    <style>
        .client-list-container {
            max-height: 800px;
            overflow-y: auto;
        }
        .email-item {
            padding: 8px;
            margin-bottom: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
            word-break: break-word;
            cursor: pointer;
        }
    </style>
@endsection

@section('settings')
    <div class="business-bookings w-full">
        <form method="POST" 
              action="{{ route('dashboard.business.bookings.store') }}" 
              enctype="multipart/form-data">
            @csrf

            {{-- Hidden Fields --}}
            <input type="hidden" id="title" name="title">
            <input type="hidden" id="start_time" name="start_time">
            <input type="hidden" id="end_time" name="end_time">
            <input type="hidden" id="timezone" name="timezone">
            <input type="hidden" id="meeting_link" name="meeting_link">
            <input type="hidden" id="calendly_event_id" name="calendly_event_id">
            <input type="hidden" id="invitee_name" name="invitee_name">
            <input type="hidden" id="invitee_email" name="invitee_email">
            <input type="hidden" name="status" value="confirmed">
            <input type="hidden" name="user_id" value="{{ auth()->id() }}">
            <input type="hidden" name="description" value="Booked via Calendly">

            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Available Clients (Copy Email)</h4>
                        </div>
                        <div class="card-body client-list-container">
                            @foreach($clients as $user)
                                <div class="email-item" onclick="navigator.clipboard.writeText('{{ $user->email }}')">
                                    {{ $user->email }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Schedule with Calendly</h4>
                        </div>
                        <div class="card-body">
                            <div class="calendly-inline-widget" id="calendlyWidget"
                                 style="min-width:320px;height:700px;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="btn-container mt-4">
                <button type="submit" class="submit-btn" id="submitBtn" disabled>
                    Continue
                </button>
            </div>
        </form>
    </div>
@endsection

@section('additional_scripts')
    <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Calendly.initInlineWidget({
                url: 'https://calendly.com/devtalha71',
                parentElement: document.getElementById('calendlyWidget'),
                prefill: {},
                utm: {}
            });

            // Listen for Calendly event scheduling
            window.addEventListener('message', function (e) {
                console.log(e);
                if (e.data.event && e.data.event === 'calendly.event_scheduled') {
                    const payload = e.data.payload;

                    // Log payload for debugging
                    console.log('Calendly Payload:', payload);

                    // Extract event and invitee details
                    const event = payload.event || {};
                    const invitee = payload.invitee || {};

                    // Set hidden field values
                    document.getElementById('title').value = event.resource?.name || 'Calendly Event';
                    document.getElementById('start_time').value = event.resource?.start_time || '';
                    document.getElementById('end_time').value = event.resource?.end_time || '';
                    document.getElementById('timezone').value = event.resource?.timezone || 'UTC';
                    document.getElementById('meeting_link').value = invitee.resource?.scheduling_url || '';
                    document.getElementById('calendly_event_id').value = event.resource?.uri || '';
                    document.getElementById('invitee_name').value = invitee.resource?.name || '';
                    document.getElementById('invitee_email').value = invitee.resource?.email || '';

                    // Enable submit button after data is populated
                    document.getElementById('submitBtn').disabled = false;
                }
            });
        });
    </script>
@endsection