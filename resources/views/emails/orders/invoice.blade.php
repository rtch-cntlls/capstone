<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $sale->sale_id }}</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .invoice-container {
            background: #fff;
            margin: 40px auto;
            padding: 30px 40px;
            max-width: 750px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #0d6efd;
            padding-bottom: 12px;
            margin-bottom: 25px;
        }

        .header h2 {
            margin: 0;
            color: #0d6efd;
            font-size: 28px;
        }

        .header small {
            color: #6c757d;
            font-size: 14px;
        }

        .details, .totals {
            width: 100%;
            margin-bottom: 20px;
            font-size: 14px;
        }

        .details td {
            padding: 6px 0;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .table th, .table td {
            border: 1px solid #dee2e6;
            padding: 10px 12px;
            text-align: right;
        }

        .table th {
            background-color: #f1f3f5;
            text-align: left;
            font-weight: 600;
            color: #1a1a1a;
        }

        .table td:first-child {
            text-align: left;
        }

        .totals {
            font-size: 15px;
            max-width: 400px;
            margin-left: auto;
        }

        .totals tr td {
            padding: 6px 0;
        }

        .totals tr:last-child td {
            font-weight: bold;
            color: #198754;
            border-top: 2px solid #dee2e6;
            padding-top: 10px;
            font-size: 16px;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            color: #6c757d;
            font-size: 14px;
        }

        @media (max-width: 600px) {
            .invoice-container {
                padding: 20px;
            }

            .table th, .table td {
                padding: 8px;
            }

            .totals {
                width: 100%;
                margin-left: 0;
            }
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="header">
            <h2>{{ $shop->shop_name }}</h2>
            <small>{{ $shop->barangay }}, {{ $shop->city }}, {{ $shop->province }}</small>
        </div>

        <table class="details">
            <tr>
                <td style="text-align:right;"><strong>Date:</strong> {{ \Carbon\Carbon::parse($sale->sale_date)->format('M d, Y h:i A') }}</td>
            </tr>
            <tr>
                <td><strong>Customer:</strong> {{ $sale->customer->user->firstname }} {{ $sale->customer->user->lastname }}</td>
            </tr>
        </table>

        <table class="table">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sale->items as $item)
                    <tr>
                        <td>{{ $item->product->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>₱{{ number_format($item->price, 2) }}</td>
                        <td>₱{{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="totals">
            <tr>
                <td><strong>Discount / Promo:</strong></td>
                <td style="text-align:right;">₱{{ number_format($sale->items->sum('discount'), 2) }}</td>
            </tr>
            @if ($sale->sale_type === 'online_order')
                <tr>
                    <td><strong>Delivery Fee:</strong></td>
                    <td style="text-align:right;">₱{{ number_format($sale->order->orderItems->sum('delivery_fee') ?? 0, 2) }}</td>
                </tr>
            @endif
            <tr>
                <td><strong>Grand Total:</strong></td>
                <td style="text-align:right;">₱{{ number_format($sale->grand_total, 2) }}</td>
            </tr>
            <tr>
                <td><strong>Amount Paid:</strong></td>
                <td style="text-align:right;">₱{{ number_format($sale->amount_pay, 2) }}</td>
            </tr>
            <tr>
                <td><strong>Change:</strong></td>
                <td style="text-align:right;">₱{{ number_format($sale->change, 2) }}</td>
            </tr>
        </table>

        <div class="footer">
            Thank you for your purchase!<br>
            We hope to serve you again soon.
        </div>
    </div>
</body>
</html>
