<<<<<<< HEAD
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessInvoice extends Model
{
    use HasFactory;
    const STATUS_DRAFT = 'draft';
    const STATUS_SENT = 'sent';
    const STATUS_PAID = 'paid';
    const STATUS_OVERDUE = 'overdue';
    protected $fillable = [
        'invoice_date',
        'due_date',
        'status',
        'client_id',
        'description',
        'amount',
        'send_email_notification',
        'payment_link'
    ];

    // Relationship with Client
    public function client()
    {
        return $this->belongsTo(BusinessClient::class, 'client_id');
    }

    // Many-to-Many relationship with Projects
    public function projects()
    {
        return $this->belongsToMany(BusinessProject::class, 'business_invoice_project', 'invoice_id', 'project_id');
    }

    // Many-to-Many relationship with Taxes
    public function taxes()
    {
        return $this->belongsToMany(BusinessTax::class, 'business_invoice_tax', 'invoice_id', 'tax_id');
    }

    public function items()
    {
        return $this->hasMany(BusinessInvoiceItem::class, 'invoice_id');
    }
=======
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessInvoice extends Model
{
    use HasFactory;
    const STATUS_DRAFT = 'draft';
    const STATUS_SENT = 'sent';
    const STATUS_PAID = 'paid';
    const STATUS_OVERDUE = 'overdue';
    protected $fillable = [
        'invoice_date',
        'due_date',
        'status',
        'client_id',
        'description',
        'amount',
        'send_email_notification',
        'payment_link'
    ];

    // Relationship with Client
    public function client()
    {
        return $this->belongsTo(BusinessClient::class, 'client_id');
    }

    // Many-to-Many relationship with Projects
    public function projects()
    {
        return $this->belongsToMany(BusinessProject::class, 'business_invoice_project', 'invoice_id', 'project_id');
    }

    // Many-to-Many relationship with Taxes
    public function taxes()
    {
        return $this->belongsToMany(BusinessTax::class, 'business_invoice_tax', 'invoice_id', 'tax_id');
    }

    public function items()
    {
        return $this->hasMany(BusinessInvoiceItem::class, 'invoice_id');
    }
>>>>>>> f4799b86f474e344473c5131907406fc349bf0dc
}