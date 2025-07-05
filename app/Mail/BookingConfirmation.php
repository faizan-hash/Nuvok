<?php

namespace App\Mail;

use App\Models\BusinessBooking;
use App\Models\BusinessClient;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $client;

    public function __construct(BusinessBooking $booking, BusinessClient $client)
    {
        $this->booking = $booking;
        $this->client = $client;
    }

    public function build()
    {
        return $this->subject('Your Booking Confirmation')
                    ->view('default.panel.business.booking.booking_confirmation');
    }
}
