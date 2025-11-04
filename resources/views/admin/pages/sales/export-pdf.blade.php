<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sales Transaction Report - {{ ucfirst(str_replace('_', ' ', $saleType)) }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background: #f0f0f0; }
        h3 { margin-bottom: 5px; }
    </style>
</head>
<body>
    <h3>Sales Transaction Report ({{ ucfirst(str_replace('_', ' ', $saleType)) }})</h3>
    <p>Generated on: {{ now()->format('F d, Y h:i A') }}</p>

    <table>
        <thead>
            <tr>
                <th>Sale Type</th>
                <th>Sale Date</th>
                <th>Amount Pay</th>
                <th>Change</th>
                <th>Grand Total</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Discount</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($sales as $sale)
                @foreach ($sale->items as $item)
                    <tr>
                        <td>{{ ucfirst(str_replace('_', ' ', $sale->sale_type)) }}</td>
                        <td>{{ optional($sale->sale_date)->format('Y-m-d H:i') }}</td>
                        <td>{{ number_format($sale->amount_pay, 2) }}</td>
                        <td>{{ number_format($sale->change, 2) }}</td>
                        <td>{{ number_format($sale->grand_total, 2) }}</td>
                        <td>{{ $item->product->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ number_format($item->price, 2) }}</td>
                        <td>{{ number_format($item->discount, 2) }}</td>
                        <td>{{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach
            @empty
                <tr><td colspan="10" style="text-align:center;">No sales data available</td></tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
