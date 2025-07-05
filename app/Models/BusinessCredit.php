<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessCredit extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invoices',
        'clients',
        'projects',
        'tasks',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
