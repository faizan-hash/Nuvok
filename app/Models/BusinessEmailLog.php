<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusinessEmailLog extends Model
{
    protected $table = 'business_email_logs';

    protected $fillable = [
        'user_id',
        'related_type',
        'related_id',
        'email_type',
        'sent_at',
    ];

    protected $casts = [
        'sent_at' => 'datetime',
    ];

    /**
     * Get the client this email log belongs to.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(BusinessClient::class, 'user_id');
    }

    /**
     * Get the related model (task, event, etc.).
     */
    public function related(): MorphTo
    {
        return $this->morphTo();
    }
}
