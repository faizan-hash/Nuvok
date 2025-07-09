<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $invoice->invoice_number }}</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 650px;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05);
        }
        .header {
            background-color: #007bff; /* Primary blue */
            color: #ffffff;
            padding: 30px 20px;
            text-align: center;
            border-bottom: 5px solid #0056b3; /* Darker blue for emphasis */
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 300;
        }
        .header .logo {
            margin-bottom: 10px;
        }
        .header .logo img {
            max-width: 150px; /* Adjust as needed */
            height: auto;
        }
        .content-body {
            padding: 25px 30px;
        }
        .greeting {
            font-size: 16px;
            margin-bottom: 20px;
            color: #555;
        }
        .section-title {
            font-size: 18px;
            color: #007bff;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            margin-bottom: 15px;
            font-weight: bold;
        }
        .details-box {
            background-color: #f9f9f9;
            border: 1px solid #e7e7e7;
            border-radius: 8px;
            padding: 15px 20px;
            margin-bottom: 20px;
        }
        .details-box p {
            margin: 5px 0;
            font-size: 14px;
        }
        .details-box strong {
            color: #333;
        }
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 25px;
            background-color: #fff;
            border: 1px solid #e7e7e7;
            border-radius: 8px;
            overflow: hidden; /* Ensures rounded corners on table */
        }
        .items-table th,
        .items-table td {
            border: 1px solid #e7e7e7;
            padding: 12px 15px;
            text-align: left;
            font-size: 14px;
        }
        .items-table th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #555;
        }
        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            font-size: 15px;
            color: #555;
        }
        .summary-row span:first-child {
            font-weight: normal;
        }
        .summary-row span:last-child {
            font-weight: bold;
            color: #333;
        }
        .total-row {
            border-top: 2px solid #ddd;
            margin-top: 15px;
            padding-top: 15px;
            font-size: 18px;
            font-weight: bold;
            color: #007bff; /* Primary blue for total */
        }
        .button-container {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            padding: 14px 28px;
            background-color: #28a745; /* Green for action */
            color: #ffffff !important;
            text-decoration: none;
            border-radius: 7px;
            font-weight: bold;
            font-size: 17px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #218838; /* Darker green on hover */
        }
        .footer {
            background-color: #f2f2f2;
            padding: 20px;
            text-align: center;
            font-size: 0.85em;
            color: #777;
            border-top: 1px solid #e7e7e7;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">
                <!-- You can add your company logo here -->
                <!-- <img src="path/to/your/logo.png" alt="Company Logo"> -->
            </div>
            <h1>Invoice #{{ $invoice->invoice_number }}</h1>
        </div>

        <div class="content-body">
            <p class="greeting">Dear {{ $invoice->client->first_name }} {{ $invoice->client->last_name }},</p>
            <p class="greeting">Here is your invoice from {{ config('app.name') }}.</p>

            <div class="section-title">Client Details</div>
            <div class="details-box">
                <p><strong>Billed To:</strong></p>
                <p>{{ $invoice->client->first_name }} {{ $invoice->client->last_name }}</p>
                <p>{{ $invoice->client->email }}</p>
                @if($invoice->client->mobile)
                    <p>{{ $invoice->client->mobile }}</p>
                @endif
            </div>

            <div class="section-title">Invoice Details</div>
            <div class="details-box">
                <p><strong>Invoice Date:</strong> {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('M d, Y') }}</p>
                @if($invoice->due_date)
                    <p><strong>Due Date:</strong> {{ \Carbon\Carbon::parse($invoice->due_date)->format('M d, Y') }}</p>
                @endif
                @if($invoice->description)
                    <p><strong>Description:</strong> {{ $invoice->description }}</p>
                @endif
            </div>

            <div class="section-title">Invoice Items</div>
            <table class="items-table">
                <thead>
                    <tr>
                        <th>Item</th>
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

            <div class="summary">
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span>{{ number_format($invoice->amount, 2) }}</span>
                </div>
                @php
                    $totalTaxAmount = 0;
                @endphp
                @foreach($invoice->taxes as $tax)
                    @php
                        $taxAmount = ($invoice->amount * $tax->rate) / 100;
                        $totalTaxAmount += $taxAmount;
                    @endphp
                    <div class="summary-row">
                        <span>{{ $tax->name }} ({{ $tax->rate }}%):</span>
                        <span>{{ number_format($taxAmount, 2) }}</span>
                    </div>
                @endforeach
                <div class="summary-row total-row">
                    <span>Total Due:</span>
                    <span>{{ number_format($invoice->amount + $totalTaxAmount, 2) }}</span>
                </div>
            </div>

            @if($invoice->payment_link)
                <div class="button-container">
                    <a href="{{ $invoice->payment_link }}" class="button">Pay Now</a>
                </div>
            @endif
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
