<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessProject extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'starting_date',
        'ending_date',
        'budget',
        'status_id',
        'client_id'
    ];

    public function client()
    {
        return $this->belongsTo(BusinessClient::class, 'client_id');
    }
        public function users()
        {
            return $this->belongsToMany(BusinessClient::class, 'business_project_user');
        }

    public function getStatusTitleAttribute()
    {
        $statuses = [
            1 => 'Not Started',
            2 => 'On Going',
            3 => 'Finished'
        ];

        return $statuses[$this->status_id] ?? 'Unknown';
    }
    public function invoices()
    {
        return $this->belongsToMany(BusinessInvoice::class, 'business_invoice_project', 'project_id', 'invoice_id');
    }
}
