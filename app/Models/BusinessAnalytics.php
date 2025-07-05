<<<<<<< HEAD
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessAnalytics extends Model
{
    use HasFactory;

    protected $table = 'business_analytics';

    protected $fillable = [
        'user_id',
        'income',
        'expense',
        'total_balance',
    ];
}
=======
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessAnalytics extends Model
{
    use HasFactory;

    protected $table = 'business_analytics';

    protected $fillable = [
        'user_id',
        'income',
        'expense',
        'total_balance',
    ];
}
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
