@use(\App\Domains\Entity\Enums\EntityEnum)
@extends('panel.layout.settings', ['layout' => 'fullwidth'])

@section('title', __('Business Calendar'))
@section('titlebar_actions', '')
@section('additional_css')
    <link href="{{ custom_theme_url('/assets/libs/select2/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('bussiness/custom.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/7692faf57e.js" crossorigin="anonymous"></script>
    <style>
    .calendar-container {
        position: relative;
        padding-bottom: 75%; /* Aspect ratio */
        height: 0;
        overflow: hidden;
    }
    
    .calendar-container iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
    }
</style>
@endsection

@section('settings')
<div class="business-clients w-full">
<div class="container">
    <h1>My Calendar</h1>
    
    <div class="calendar-container">
          @if(!empty($events))
            <ul>
                @foreach ($events as $event)
                    <li>
                        <strong>{{ $event->getSummary() }}</strong><br>
                        Start: {{ $event->getStart()->getDateTime() ?? $event->getStart()->getDate() }}<br>
                        End: {{ $event->getEnd()->getDateTime() ?? $event->getEnd()->getDate() }}
                    </li>
                @endforeach
            </ul>
        @else
            <p>No upcoming events found.</p>
        @endif
    </div>
</div>
</div>

@section('additional_scripts')
@endsection
@endsection