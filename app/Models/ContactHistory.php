<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action_type',
        'reference_id',
        'reference_type',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
} 