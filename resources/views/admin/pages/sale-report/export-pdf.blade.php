<!DOCTYPE html>
<html>
<head>
    <title>Products Sold Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ccc; padding: 6px; text-align: left; }
        th { background-color: #f5f5f5; }
        h4 { text-align: center; margin-bottom: 0; }
        small { text-align: center; display: block; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h4>Products Sold</h4>
    <small>{{ \Carbon\Carbon::parse($from)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($to)->format('F j, Y') }}</small>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Product Name</th>
                <th>QTY Sold</th>
                <th>Sale Price</th>
                <th>Total</th>
                <th>Revenue</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productsSold as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item['product']->product_name ?? 'Unknown Product' }}</td>
                    <td>{{ $item['total_sold'] }}</td>
                    <td>₱{{ number_format($item['avg_price'], 2) }}</td>
                    <td>₱{{ number_format($item['total_sale'], 2) }}</td>
                    <td>₱{{ number_format($item['total_revenue'], 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
