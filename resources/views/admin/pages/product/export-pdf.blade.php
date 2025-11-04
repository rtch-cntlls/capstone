<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Products Export</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #999;
            padding: 6px 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        small {
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <h2>Product List</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Category</th>
                <th>Status</th>
                <th>Cost Price</th>
                <th>Sale Price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->product_id }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->category->name ?? 'Uncategorized' }}</td>
                    <td>{{ $product->status }}</td>
                    <td>{{ number_format($product->cost_price, 2) }}</td>
                    <td>{{ number_format($product->sale_price, 2) }}</td>
                    <td>{{ $product->inventory->instock }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <small>Generated on {{ now()->format('M-d-Y h:i a') }}</small>
</body>
</html>
