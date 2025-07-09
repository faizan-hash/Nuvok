<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessBookingCalendly extends Model
{
    use HasFactory;

    protected $table = 'business_booking_calendly';

    protected $fillable = [
        'calendly_event_id',
        'event_type',
        'invitee_name',
        'invitee_email',
        'invitee_details',
        'start_time',
        'end_time',
        'status',
        'payment_status',
        'cancel_reason',
        'cancel_url',
        'reschedule_url',
        'location',
        'canceled_at',
        'canceler_name'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
        'canceled_at' => 'datetime',
        'invitee_details' => 'array'
    ];

    public function clients()
    {
        return $this->belongsToMany(BusinessClient::class, 'business_booking_client', 'booking_id', 'client_id');
    }

    // Helper method to check if booking is canceled
    public function isCanceled()
    {
        return $this->status === 'canceled';
    }

    // Helper method to check if booking is completed
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    // Helper method to check if payment is done
    public function isPaid()
    {
        return $this->payment_status === 'paid';
    }
}