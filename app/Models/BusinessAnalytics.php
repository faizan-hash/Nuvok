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
