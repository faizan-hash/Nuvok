<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessTaskAttachmentFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'task_id',
        'user_id',
        'file_path',
        'file_name',
        'mime_type',
        'file_size',
    ];

    protected $appends = ['file_url'];

    public function getFileUrlAttribute()
    {
        return asset('storage/'.$this->file_path);
    }

    public function task()
    {
        return $this->belongsTo(BusinessTask::class);
    }

    public function user()
    {
        return $this->belongsTo(BusinessClient::class);
    }
}