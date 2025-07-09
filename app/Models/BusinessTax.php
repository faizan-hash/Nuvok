<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessTax extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'business_taxes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'rate',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'rate' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * Scope a query to search taxes by name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('name', 'like', '%'.$search.'%');
    }

    /**
     * Scope a query to filter by tax rate range.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param float $min
     * @param float $max
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeRateBetween($query, $min, $max)
    {
        return $query->whereBetween('rate', [$min, $max]);
    }

    /**
     * Get the formatted rate with percentage sign.
     *
     * @return string
     */
    public function getFormattedRateAttribute()
    {
        return $this->rate.'%';
    }

    /**
     * Get the created_at date in a human-readable format.
     *
     * @return string|null
     */
    public function getCreatedAtFormattedAttribute()
    {
        return $this->created_at?->format('M d, Y h:i A');
    }

    /**
     * Get the updated_at date in a human-readable format.
     *
     * @return string|null
     */
    public function getUpdatedAtFormattedAttribute()
    {
        return $this->updated_at?->format('M d, Y h:i A');
    }
}