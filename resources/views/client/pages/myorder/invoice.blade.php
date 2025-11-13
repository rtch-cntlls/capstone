<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice #{{ $sale->sale_id }}</title>
    <style>
        /* Font & Reset */
        body { 
            font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; 
            color: #333; 
            font-size: 16px; 
            margin: 0; 
            padding: 0; 
            background: #f7f7f7;
        }

        .container {
            max-width: 900px;
            margin: 30px auto;
            padding: 30px;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        }

        h2 { 
            font-size: 32px; 
            margin: 0; 
            color: #1a73e8;
        }

        .shop-info {
            text-align: center;
            margin-bottom: 40px;
            line-height: 1.4;
            color: #555;
            font-size: 18px;
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 30px;
            font-size: 18px;
        }

        .invoice-header div span {
            font-weight: bold;
            font-size: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 18px;
        }

        th {
            background-color: #f1f5f9;
            padding: 15px;
            text-align: left;
            font-weight: 700;
            color: #1a202c;
            font-size: 18px;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #e2e8f0;
            font-size: 18px;
        }

        .text-end { text-align: right; }
        .fw-bold { font-weight: bold; }

        .summary {
            margin-top: 30px;
            max-width: 450px;
            float: right;
            font-size: 18px;
        }

        .summary div {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
        }

        .summary .grand-total {
            font-size: 22px;
            font-weight: bold;
            color: #16a34a;
            border-top: 2px solid #e2e8f0;
            padding-top: 12px;
        }

        .thank-you {
            clear: both;
            text-align: center;
            margin-top: 80px;
            font-size: 18px;
            color: #555;
        }

        /* Small devices adjustments */
        @media (max-width: 600px) {
            .invoice-header {
                flex-direction: column;
                gap: 15px;
                font-size: 16px;
            }
            .summary {
                float: none;
                width: 100%;
                font-size: 16px;
            }
            table, th, td {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="shop-info">
            <h2>{{ $shop->shop_name }}</h2>
            <div>{{ $shop->barangay }}, {{ $shop->city }}, {{ $shop->province }}</div>
        </div>

        <div class="invoice-header">
            <div>
                <span>Customer:</span> 
                {{ $sale->customer->user->firstname ?? '' }} {{ $sale->customer->user->lastname ?? '' }}
            </div>
            <div>
                <span>Date:</span> {{ \Illuminate\Support\Carbon::parse($sale->sale_date)->format('M d, Y h:i A') }}
            </div>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Item</th>
                    <th class="text-end">Qty</th>
                    <th class="text-end">Price</th>
                    <th class="text-end">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sale->items as $item)
                    <tr>
                        <td>{{ $item->product->product_name ?? 'N/A' }}</td>
                        <td class="text-end">{{ $item->quantity }}</td>
                        <td class="text-end"> {{ number_format($item->price, 2) }}</td>
                        <td class="text-end"> {{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="summary">
            <div><span>Discount / Promo:</span> <span> {{ number_format($sale->items->sum('discount') ?? 0, 2) }}</span></div>
            @if ($sale->sale_type === 'online_order')
                <div><span>Delivery / Shipping Fee:</span> <span> {{ number_format(optional($sale->order)->orderItems->sum('delivery_fee') ?? 0, 2) }}</span></div>
            @endif
            <div class="grand-total"><span>Grand Total:</span> <span> {{ number_format($sale->grand_total, 2) }}</span></div>
            <div><span>Amount Paid:</span> <span> {{ number_format($sale->amount_pay, 2) }}</span></div>
            <div><span>Change:</span> <span> {{ number_format($sale->change, 2) }}</span></div>
        </div>

        <div class="thank-you">
            <p>Thank you for your purchase!</p>
        </div>
    </div>
</body>
</html>
