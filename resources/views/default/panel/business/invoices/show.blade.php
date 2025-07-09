@use(\App\Domains\Entity\Enums\EntityEnum)
@extends('panel.layout.settings', ['layout' => 'fullwidth'])

@section('title', __('Invoice Details'))
@section('titlebar_actions')
    <a href="{{ route('dashboard.business.invoices.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left mr-2"></i> {{ __('Back to Invoices') }}
    </a>
@endsection

@section('additional_css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{ asset('bussiness/custom-create.css') }}" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<style>
    .invoice-detail-container {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.05);
        padding: 2.5rem;
        font-family: 'Inter', sans-serif;
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.35rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .status-draft { background-color: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; }
    .status-sent { background-color: #dbeafe; color: #1d4ed8; border: 1px solid #93c5fd; }
    .status-paid { background-color: #dcfce7; color: #166534; border: 1px solid #86efac; }
    .status-cancelled { background-color: #fee2e2; color: #b91c1c; border: 1px solid #fca5a5; }
    
    .detail-card {
        background: #ffffff;
        border-radius: 10px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
        border: 1px solid #f1f5f9;
        transition: all 0.2s ease;
    }
    
    .detail-card:hover {
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        border-color: #e2e8f0;
    }
    
    .items-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
    }
    
    .items-table th {
        background-color: #f8fafc;
        font-weight: 600;
        color: #475569;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
        padding: 0.75rem 1.25rem;
    }
    
    .items-table td {
        padding: 1rem 1.25rem;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
    }
    
    .items-table tr:last-child td {
        border-bottom: none;
    }
    
    .summary-card {
        background: #ffffff;
        border-radius: 10px;
        padding: 1.5rem;
        margin-top: 2rem;
        border: 1px solid #f1f5f9;
    }
    
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.75rem;
        color: #475569;
    }
    
    .summary-row.total {
        border-top: 1px solid #f1f5f9;
        padding-top: 1rem;
        margin-top: 1rem;
        font-weight: 700;
        color: #1e293b;
        font-size: 1.1rem;
    }
    
    .invoice-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 2.5rem;
        flex-wrap: wrap;
        gap: 1.5rem;
    }
    
    .invoice-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 0.5rem;
    }
    
    .invoice-actions {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }
    
    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1e293b;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .section-title i {
        color: #64748b;
        font-size: 1rem;
    }
    
    .text-label {
        color: #64748b;
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }
    
    .text-value {
        color: #1e293b;
        font-weight: 500;
        margin-bottom: 0.75rem;
    }
    
    .grid-cols-2 {
        display: grid;
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 1.5rem;
    }
    
    @media (max-width: 768px) {
        .grid-cols-2 {
            grid-template-columns: 1fr;
        }
        
        .invoice-header {
            flex-direction: column;
        }
    }
</style>
@endsection

@section('settings')
<div class="business-invoices w-full">
    <div class="invoice-detail-container">
        <div class="invoice-header">
            <div>
                <h1 class="invoice-title">Invoice #{{ $invoice->invoice_number }}</h1>
                <span class="status-badge status-{{ $invoice->status }}">
                    <i class="fas fa-circle mr-1" style="font-size: 0.5rem;"></i>
                    {{ ucfirst($invoice->status) }}
                </span>
            </div>
            <div class="invoice-actions">
                <a href="{{ route('dashboard.business.invoices.download', $invoice->id) }}" 
                   class="btn btn-primary">
                    <i class="fas fa-file-pdf mr-2"></i> Download PDF
                </a>
                @if($invoice->status == 'sent')
                <a href="{{ route('dashboard.business.invoices.pay', $invoice->id) }}" 
                   class="btn btn-success">
                    <i class="fas fa-credit-card mr-2"></i> Pay Now
                </a>
                @endif
            </div>
        </div>

        <div class="grid-cols-2 mb-6">
            <div class="detail-card">
                <h3 class="section-title"><i class="fas fa-building"></i> From</h3>
                <div class="mb-3">
                    <p class="text-label">Company Name</p>
                    <p class="text-value">{{ config('app.name') }}</p>
                </div>
                <div class="mb-3">
                    <p class="text-label">Address</p>
                    <p class="text-value">{{ config('app.address') }}</p>
                </div>
                <div class="mb-3">
                    <p class="text-label">Email</p>
                    <p class="text-value">{{ config('app.email') }}</p>
                </div>
                <div>
                    <p class="text-label">Phone</p>
                    <p class="text-value">{{ config('app.phone') }}</p>
                </div>
            </div>

            <div class="detail-card">
                <h3 class="section-title"><i class="fas fa-user"></i> To</h3>
                <div class="mb-3">
                    <p class="text-label">Client Name</p>
                    <p class="text-value">{{ $invoice->client->first_name }} {{ $invoice->client->last_name }}</p>
                </div>
                <div class="mb-3">
                    <p class="text-label">Client Email</p>
                    <p class="text-value">{{ $invoice->client->email }}</p>
                </div>
                @if($invoice->client->phone)
                    <div class="mb-3">
                        <p class="text-label">Client Phone</p>
                        <p class="text-value">{{ $invoice->client->phone }}</p>
                    </div>
                @endif
                @if($invoice->client->address)
                    <div>
                        <p class="text-label">Client Address</p>
                        <p class="text-value">{{ $invoice->client->address }}</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="detail-card">
            <h3 class="section-title"><i class="fas fa-info-circle"></i> Invoice Details</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                <div>
                    <p class="text-label">Invoice Number</p>
                    <p class="text-value">{{ $invoice->invoice_number }}</p>
                </div>
                <div>
                    <p class="text-label">Invoice Date</p>
                    <p class="text-value">{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('M d, Y') }}</p>
                </div>
                @if($invoice->due_date)
                    <div>
                        <p class="text-label">Due Date</p>
                        <p class="text-value">{{ \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') }}</p>
                    </div>
                @endif
            </div>

            @if($invoice->description)
                <div class="mt-4">
                    <p class="text-label">Description</p>
                    <p class="text-value">{{ $invoice->description }}</p>
                </div>
            @endif

            @if($invoice->projects->count() > 0)
                <div class="mt-4">
                    <p class="text-label">Projects</p>
                    <p class="text-value">{{ $invoice->projects->pluck('title')->implode(', ') }}</p>
                </div>
            @endif
        </div>

        <div class="detail-card">
            <h3 class="section-title"><i class="fas fa-clipboard-list"></i> Items</h3>
            <div class="overflow-x-auto">
                <table class="items-table">
                    <thead>
                        <tr>
                            <th>Item Name</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($invoice->items as $item)
                            <tr>
                                <td>{{ $item->item_name }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td>{{ number_format($item->unit_price, 2) }}</td>
                                <td>{{ number_format($item->subtotal, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-row">
                <span>Subtotal:</span>
                <span>{{ number_format($invoice->amount, 2) }}</span>
            </div>
            @foreach($invoice->taxes as $tax)
                <div class="summary-row">
                    <span>{{ $tax->name }} ({{ $tax->rate }}%):</span>
                    <span>{{ number_format(($invoice->amount * $tax->rate) / 100, 2) }}</span>
                </div>
            @endforeach
            <div class="summary-row total">
                <span>Total Amount:</span>
                <span>{{ number_format($invoice->amount + $invoice->taxes->sum(fn($tax) => ($invoice->amount * $tax->rate) / 100), 2) }}</span>
            </div>
        </div>

        @if($invoice->status == 'sent')
            <div class="mt-6 text-center">
                <a href="{{ route('dashboard.business.invoices.pay', $invoice->id) }}" class="btn btn-success btn-lg">
                    Proceed to Payment
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Any additional JavaScript if needed
});
</script>
@endpush