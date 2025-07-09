<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BusinessInvoiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'item_name',
        'quantity',
        'unit_price',
        'subtotal',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(BusinessInvoice::class);
    }
}
