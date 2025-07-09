<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessTaskTimer extends Model
{
    use HasFactory;

    protected $fillable = [
    'task_id',
    'user_id',
    'started_at',
    'ended_at',
    'duration',
    'start_time', // ← Add this
];

    protected $casts = [
        'started_at' => 'datetime',
        'ended_at' => 'datetime',
    ];

    public function task()
    {
        return $this->belongsTo(BusinessTask::class);
    }

    public function user()
    {
        return $this->belongsTo(BusinessClient::class);
    }
}