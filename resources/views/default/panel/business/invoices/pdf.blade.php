<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
        }
        .invoice-title {
            font-size: 24px;
            font-weight: bold;
            color: #1f2937;
        }
        .status-badge {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 9999px;
            font-size: 14px;
            font-weight: 500;
            margin-left: 10px;
        }
        .status-draft { background-color: #e5e7eb; color: #374151; }
        .status-sent { background-color: #dbeafe; color: #1e40af; }
        .status-paid { background-color: #dcfce7; color: #166534; }
        .status-cancelled { background-color: #fee2e2; color: #991b1b; }
        .details-grid {
            display: flex;
            margin-bottom: 30px;
        }
        .from-to-section {
            display: flex;
            width: 100%;
            gap: 30px;
        }
        .from-card, .to-card {
            width: 50%;
            padding: 15px;
            background: #f9fafb;
            border-radius: 8px;
        }
        .section-title {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 15px;
            padding-bottom: 8px;
            border-bottom: 1px solid #e5e7eb;
        }
        .invoice-meta {
            margin-bottom: 30px;
        }
        .meta-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .meta-label {
            color: #6b7280;
        }
        .meta-value {
            color: #1f2937;
            font-weight: 500;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .items-table th, .items-table td {
            padding: 10px 15px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }
        .items-table th {
            background-color: #f3f4f6;
            font-weight: 600;
            color: #4b5563;
        }
        .summary-card {
            margin-left: auto;
            width: 300px;
            background: #f9fafb;
            padding: 20px;
            border-radius: 8px;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .summary-row.total {
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
            margin-top: 10px;
            font-weight: 600;
            font-size: 16px;
        }
        .notes-section {
            margin-top: 30px;
            padding: 20px;
            background: #f9fafb;
            border-radius: 8px;
        }
        .notes-title {
            font-size: 18px;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 10px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            color: #9ca3af;
            font-size: 12px;
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <div>
            <span class="invoice-title">Invoice #{{ $invoice->invoice_number }}</span>
            <span class="status-badge status-{{ $invoice->status }}">
                {{ ucfirst($invoice->status) }}
            </span>
        </div>
        <div>
            <p>Generated: {{ \Carbon\Carbon::now()->format('M d, Y') }}</p>
        </div>
    </div>

    <div class="from-to-section">
        <div class="from-card">
            <div class="section-title">From</div>
            <p>{{ config('app.name') }}</p>
            <p>{{ config('app.address') }}</p>
            <p>{{ config('app.email') }}</p>
            <p>{{ config('app.phone') }}</p>
        </div>
        
        <div class="to-card">
            <div class="section-title">To</div>
            <p>{{ $invoice->client->first_name }} {{ $invoice->client->last_name }}</p>
            <p>{{ $invoice->client->email }}</p>
            @if($invoice->client->phone)
                <p>{{ $invoice->client->phone }}</p>
            @endif
            @if($invoice->client->address)
                <p>{{ $invoice->client->address }}</p>
            @endif
        </div>
    </div>

    <div class="invoice-meta">
        <div class="meta-row">
            <span class="meta-label">Invoice Number:</span>
            <span class="meta-value">{{ $invoice->invoice_number }}</span>
        </div>
        <div class="meta-row">
            <span class="meta-label">Invoice Date:</span>
            <span class="meta-value">{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('M d, Y') }}</span>
        </div>
        <div class="meta-row">
            <span class="meta-label">Due Date:</span>
            <span class="meta-value">{{ $invoice->due_date ? \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') : '-' }}</span>
        </div>
        @if($invoice->description)
            <div class="meta-row">
                <span class="meta-label">Description:</span>
                <span class="meta-value">{{ $invoice->description }}</span>
            </div>
        @endif
        @if($invoice->projects->count() > 0)
            <div class="meta-row">
                <span class="meta-label">Projects:</span>
                <span class="meta-value">{{ $invoice->projects->pluck('title')->implode(', ') }}</span>
            </div>
        @endif
    </div>

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

    <div class="footer">
        <p>Thank you for your business!</p>
        <p>{{ config('app.name') }}</p>
    </div>
</body>
</html>