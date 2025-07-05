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
<div class="business-booking-form">
    <form method="POST" action="{{ isset($booking) ? route('dashboard.business.calendly.update', $booking->id) : route('dashboard.business.calendly.store') }}">
        @csrf
        @if(isset($booking))
            @method('PUT')
        @endif

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
            <!-- Left Column -->
            <div class="space-y-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Booking Details</h4>
                    </div>
                    <div class="card-body space-y-4">
                        <div class="form-group">
                            <label for="event_type">Event Type</label>
                            <input type="text" id="event_type" name="event_type" class="form-control"
                                   value="{{ old('event_type', $booking->event_type ?? '') }}" readonly>
                                        @error('event_type')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                        </div>

                        <div class="form-group">
                            <label for="invitee_name">Client Name</label>
                            <input type="text" id="invitee_name" name="invitee_name" class="form-control"
                                   value="{{ old('invitee_name', $booking->invitee_name ?? '') }}" required>
                                        @error('invitee_name')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                        </div>

                        <div class="form-group">
                            <label for="invitee_email">Client Email</label>
                            <input type="email" id="invitee_email" name="invitee_email" class="form-control"
                                   value="{{ old('invitee_email', $booking->invitee_email ?? '') }}" required>
                                        @error('invitee_email')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="form-group">
                                <label for="start_time">Start Time</label>
                                <input type="datetime-local" id="start_time" name="start_time" class="form-control"
                                       value="{{ old('start_time', isset($booking) ? $booking->start_time->format('Y-m-d\TH:i') : '') }}" required>
                                            @error('start_time')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                            </div>
                            <div class="form-group">
                                <label for="end_time">End Time</label>
                                <input type="datetime-local" id="end_time" name="end_time" class="form-control"
                                       value="{{ old('end_time', isset($booking) ? $booking->end_time->format('Y-m-d\TH:i') : '') }}" required>
                                            @error('end_time')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select id="status" name="status" class="form-control" required>
                                <option value="scheduled" {{ old('status', $booking->status ?? '') == 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                <option value="confirmed" {{ old('status', $booking->status ?? '') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="completed" {{ old('status', $booking->status ?? '') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="cancelled" {{ old('status', $booking->status ?? '') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                                 @error('status')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4>Additional Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="invitee_details">Notes</label>
                            <textarea id="invitee_details" name="invitee_details" class="form-control" rows="4">{{ old('invitee_details', $booking->invitee_details ?? '') }}</textarea>
                                 @error('invitee_details')
                    <span class="error-message">{{ $message }}</span>
                    @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column -->
            <div class="space-y-6">
                <div class="card">
                    <div class="card-header">
                        <div class="flex items-center justify-between">
                            <h4>Schedule with Calendly</h4>
                            @if(isset($booking))
                                <span class="calendly-badge">
                                    <i class="fas fa-calendar-check me-1"></i> Scheduled via Calendly
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        @if(!isset($booking))
                            <!-- Calendly inline widget begin -->
                            <div class="calendly-inline-widget" 
                                 data-url="https://calendly.com/devtalha71" 
                                 style="min-width:320px;height:700px;"></div>
                            <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
                            <!-- Calendly inline widget end -->
                        @else
                            <div class="p-4 text-center bg-gray-50 rounded-lg">
                                <p class="text-gray-600">This booking was created via Calendly. To reschedule, please use the original Calendly link.</p>
                                <a href="{{ $booking->calendly_uri ?? '#' }}" class="btn btn-primary mt-3" target="_blank">
                                    <i class="fas fa-external-link-alt me-2"></i> View in Calendly
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex justify-end space-x-3">
            <a href="{{ route('dashboard.business.calendly.index') }}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">
                {{ isset($booking) ? 'Update Booking' : 'Continue' }}
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')

@endpush