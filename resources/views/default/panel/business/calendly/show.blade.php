@use(\App\Domains\Entity\Enums\EntityEnum)
@extends('panel.layout.settings', ['layout' => 'fullwidth'])

@section('title', isset($booking) ? __('Edit Booking') : __('Create Booking'))
@section('titlebar_actions', '')

@section('additional_css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('bussiness/custom-create.css') }}" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<script src="https://kit.fontawesome.com/7692faf57e.js" crossorigin="anonymous"></script>
    <style>
        .calendly-badge {
            background-color: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
            font-size: 0.75rem;
            display: inline-flex;
            align-items: center;
        }
        .calendly-inline-widget {
            min-width: 320px;
            height: 700px;
            border: 1px solid #e5e7eb;
            border-radius: 0.5rem;
        }
    </style>
@endsection

@section('settings')
<div class="business-booking-details">
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Booking Details</h2>
        </div>
        <div class="card-body">
            <!-- Your existing booking details -->

            @if($booking->calendly_event_id)
                <div class="mt-4 calendly-actions">
                    @if($booking->status !== 'canceled')
                        @if($booking->reschedule_url)
                            <a href="{{ $booking->reschedule_url }}" class="btn btn-warning" target="_blank">
                                Reschedule via Calendly
                            </a>
                        @endif
                        
                        @if($booking->cancel_url)
                            <a href="{{ $booking->cancel_url }}" class="btn btn-danger" target="_blank">
                                Cancel via Calendly
                            </a>
                        @endif
                    @endif
                </div>
            @endif

            <!-- Your existing actions -->
        </div>
    </div>
</div>
</div>
@endsection