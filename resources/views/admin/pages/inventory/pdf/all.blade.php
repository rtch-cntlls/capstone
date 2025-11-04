<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Report</title>
    <link rel="stylesheet" href="{{public_path('style/inventory_report_all.css')}}">
</head>
<body>
    <div class="header">
        <h2>Inventory Report</h2>
    </div>
    <table>
        <thead>
            <tr>
                <th>Inventory ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>QTY</th>
                <th>Cost Price</th>
                <th>Unit Price</th>
            </tr>
        </thead>
        <tbody>
            @forelse($products as $index => $product)
                <tr>
                    <td style="text-align: center;">{{ 'INV' . (1000 + $index + 1) }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                    <td style="text-align: center;">{{ $product->inventory->instock ?? 0 }}</td>
                    <td>{{ number_format($product->cost_price, 2) ?? '0.00' }}</td>
                    <td>{{ number_format($product->sale_price, 2) ?? '0.00' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">No inventory data found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
