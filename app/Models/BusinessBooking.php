<<<<<<< HEAD
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BusinessBooking extends Model
{
    use SoftDeletes;

    protected $table = 'business_bookings';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'start_time',
        'end_time',
        'timezone',
        'status',
        'meeting_link',
    ];

    public function user()
    {
        return $this->belongsTo(BusinessClient::class, 'user_id');
    }

    // Clients participating in the booking
    public function clients()
    {
        return $this->belongsToMany(BusinessClient::class, 'business_booking_client', 'booking_id', 'client_id');
    }
=======
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class BusinessBooking extends Model
{
    use SoftDeletes;

    protected $table = 'business_bookings';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'start_time',
        'end_time',
        'timezone',
        'status',
        'meeting_link',
    ];

    public function user()
    {
        return $this->belongsTo(BusinessClient::class, 'user_id');
    }

    // Clients participating in the booking
    public function clients()
    {
        return $this->belongsToMany(BusinessClient::class, 'business_booking_client', 'booking_id', 'client_id');
    }
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
}