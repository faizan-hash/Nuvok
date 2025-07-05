<p>Hello {{ $client->name }},</p>

<p>Your booking has been confirmed:</p>

<ul>
    <li>Title: {{ $booking->title }}</li>
    <li>Date: {{ \Carbon\Carbon::parse($booking->start_time)->format('F j, Y g:i A') }} - {{ \Carbon\Carbon::parse($booking->end_time)->format('g:i A') }}</li>
    <li>Timezone: {{ $booking->timezone }}</li>
</ul>

@if($booking->meeting_link)
    <p>Join Link: <a href="{{ $booking->meeting_link }}">{{ $booking->meeting_link }}</a></p>
@endif

<p>Thanks,</p>
<p>Your Company</p>
