<<<<<<< HEAD
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BusinessClient extends Authenticatable {
    use HasFactory;

    protected $table = 'business_clients';

    protected $fillable = [
        'avatar',
        'first_name',
        'last_name',
        'id_number',
        'company_name',
        'email',
        'mobile',
        'password',
        'industry',
        'country',
        'city',
        'purchase_history',
        'job_type',
        'address',
    ];

    protected $hidden = [
        'password',
    ];
    public function projects()
{
    return $this->belongsToMany(BusinessProject::class, 'business_project_user', 'business_client_id', 'business_project_id');
}
public function invoices()
{
    return $this->hasMany(BusinessInvoice::class, 'client_id');
}
public function bookings()
{
    return $this->hasMany(BusinessBooking::class, 'user_id');
}

// Bookings this user is participating in
public function participantBookings()
{
    return $this->belongsToMany(BusinessBooking::class, 'business_booking_client', 'client_id', 'booking_id');
}
public function tasks()
{
    return $this->hasMany(BusinessTask::class, 'client_id');
}
}
=======
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class BusinessClient extends Authenticatable {
    use HasFactory;

    protected $table = 'business_clients';

    protected $fillable = [
        'avatar',
        'first_name',
        'last_name',
        'id_number',
        'company_name',
        'email',
        'mobile',
        'password',
        'industry',
        'country',
        'city',
        'purchase_history',
        'job_type',
        'address',
    ];

    protected $hidden = [
        'password',
    ];
    public function projects()
{
    return $this->belongsToMany(BusinessProject::class, 'business_project_user', 'business_client_id', 'business_project_id');
}
public function invoices()
{
    return $this->hasMany(BusinessInvoice::class, 'client_id');
}
public function bookings()
{
    return $this->hasMany(BusinessBooking::class, 'user_id');
}

// Bookings this user is participating in
public function participantBookings()
{
    return $this->belongsToMany(BusinessBooking::class, 'business_booking_client', 'client_id', 'booking_id');
}
public function tasks()
{
    return $this->hasMany(BusinessTask::class, 'client_id');
}
}
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
