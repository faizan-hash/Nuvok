<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserOrder extends Model
{
    protected $guarded = [];

    protected $casts = [
        'payload' => 'array',
    ];

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted(): void
    {
        static::created(function ($model) {
            if ($model->plan) {
                if ($model->plan['hidden']) {
                    if ($model->plan['max_subscribe'] != -1 && $model->plan['max_subscribe'] != 0) {
                        $model->plan['max_subscribe'] = $model->plan['max_subscribe'] - 1;
                        $model->plan->save();
                    }
                }
            }
        });
    }
}
