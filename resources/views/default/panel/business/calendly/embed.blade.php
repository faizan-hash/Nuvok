@use(\App\Domains\Entity\Enums\EntityEnum)
@extends('panel.layout.settings', ['layout' => 'fullwidth'])

@section('title', __('Schedule Appointment'))
@section('titlebar_actions', '')

@section('additional_css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        .calendly-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .calendly-card {
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .calendly-header {
            padding: 1.5rem;
            border-bottom: 1px solid #e5e7eb;
            background-color: #f9fafb;
        }
        
        .calendly-header h2 {
            font-size: 1.5rem;
            font-weight: 600;
            color: #111827;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .calendly-body {
            padding: 0;
        }
        
        .calendly-inline-widget {
            min-width: 320px;
            height: 700px;
            border: none;
        }
        
        .calendly-badge {
            background-color: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
            padding: 0.25rem 0.75rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
        }
        
        .calendly-back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: #4b5563;
            text-decoration: none;
            margin-bottom: 1rem;
            transition: color 0.2s;
        }
        
        .calendly-back-link:hover {
            color: #111827;
        }
    </style>
@endsection

@section('settings')
<div class="calendly-container">
    <a href="{{ route('dashboard.business.calendly.index') }}" class="calendly-back-link">
        <i class="fas fa-arrow-left"></i>
        Back to Bookings
    </a>
    
    <div class="calendly-card">
        <div class="calendly-header">
            <h2>
                <span class="calendly-badge">
                    <i class="fas fa-calendar-check"></i>
                    Powered by Calendly
                </span>
                Schedule a New Appointment
            </h2>
        </div>
        <div class="calendly-body">
            <!-- Calendly inline widget begin -->
            <div class="calendly-inline-widget" 
                 data-url="https://calendly.com/{{ config('services.calendly.username') }}" 
                 style="min-width:320px;height:700px;"></div>
            <script type="text/javascript" src="https://assets.calendly.com/assets/external/widget.js" async></script>
            <!-- Calendly inline widget end -->
        </div>
    </div>
</div>

@section('additional_scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Listen for Calendly events
            window.addEventListener('message', function(e) {
                if (e.data.event && e.data.event.indexOf('calendly') === 0) {
                    console.log('Calendly event:', e.data);
                    
                    // Handle specific events
                    if (e.data.event === 'calendly.event_scheduled') {
                        // You could trigger a notification or redirect here
                        console.log('Appointment scheduled:', e.data.payload);
                    }
                }
            });
        });
    </script>
@endsection
@endsection