<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessTask extends Model
{
    use HasFactory;
protected $table = 'business_tasks';

    protected $fillable = [
        'project_id',
        'title',
        'description',
        'starting_date',
        'due_date',
        'priority_id',
        'status_id',
        'job_type_id',           // NEW
        'initial_task_image',    // NEW
        'completed_task_image',    // NEW
    ];

    protected $dates = [
        'starting_date',
        'due_date',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'starting_date' => 'date',
        'due_date' => 'date',
    ];

    public function priority()
    {
        return $this->belongsTo(BusinessPriority::class);
    }

    public function status()
    {
        return $this->belongsTo(BusinessStatus::class);
    }

    public function project()
    {
        return $this->belongsTo(BusinessProject::class);
    }

  

    public function jobType()
    {
        return $this->belongsTo(BusinessJobType::class, 'job_type_id');
    }


    public function clients()
    {
        return $this->belongsToMany(BusinessClient::class, 'business_task_user', 'business_task_id', 'user_id')
                    ->withTimestamps();
    }

    public function attachments()
    {
        return $this->hasMany(BusinessTaskAttachmentFile::class, 'task_id');
    }

    public function comments()
    {
        return $this->hasMany(BusinessTaskComment::class, 'task_id');
    }

    public function timers()
    {
        return $this->hasMany(BusinessTaskTimer::class, 'task_id');
    }
}
