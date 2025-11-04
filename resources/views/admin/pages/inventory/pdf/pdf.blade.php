<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Report</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ public_path('style/pdf.css') }}">
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Inventory Report</h2>
        </div>
        <div class="date-time">
            <div>
                Date: <strong>{{ now()->setTimezone('Asia/Manila')->format('F d, Y') }}</strong>
            </div>
            <div>
                Time: <strong>{{ now()->setTimezone('Asia/Manila')->format('h:i A') }}</strong>
            </div>
        </div>

        <div class="section">
            <div class="section-title">Product Overview</div><hr>
            <div class="row">
                <div class="col">
                    <div class="info-label">Product Name</div>
                    <div class="info-value">{{ $inventory->product->product_name }}</div>
                </div>
                <div class="col">
                    <div class="info-label">Category</div>
                    <div class="info-value">{{ $inventory->product->category->name }}</div>
                </div>
                <div class="col" style="flex: 1 1 100%;">
                    <div class="info-label">Description</div>
                    <div class="info-value">{{ $inventory->product->description ?? 'No description available.' }}</div>
                </div>
            </div>
        </div>     
        <div class="section">
            <div class="section-title">Stock Information</div><hr>
            <div class="row">
                <div class="col">
                    <div class="info-label">Total Stock</div>
                    <div class="info-value">{{ $inventory->instock }} pcs</div>
                </div>
                <div class="col">
                    <div class="info-label">Available Stock</div>
                    <div class="info-value">{{ $inventory->instock }} pcs</div>
                </div>
            </div>
        </div>
        <div class="section">
            <div class="section-title">Pricing Information</div><hr>
            <div class="row">
                <div class="col">
                    <div class="info-label">Cost Price</div>
                    <div class="info-value">Php {{ number_format($inventory->product->cost_price, 2) }}</div>
                </div>
                <div class="col">
                    <div class="info-label">Selling Price</div>
                    <div class="info-value">Php {{ number_format($inventory->product->sale_price, 2) }}</div>
                </div>
                <div class="col">
                    <div class="info-label">Total Inventory Value</div>
                    <div class="info-value">Php {{ number_format($totalValue, 2) }}</div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
