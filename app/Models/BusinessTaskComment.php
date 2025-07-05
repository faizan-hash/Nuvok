<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessTaskComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'user_id',
        'comment',
    ];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d H:i:s',
        'updated_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function task()
    {
        return $this->belongsTo(BusinessTask::class);
    }

public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function client()
{
    return $this->belongsTo(BusinessClient::class, 'user_id');
}

public function getLinkedUserAttribute()
{
    return $this->client ?? $this->user;
}

}