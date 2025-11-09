<div class="d-flex justify-content-between">
    <div class="me-3">
        <div class="mb-2 fw-bold">Product Market Share</div>
        <ul style="padding-left: 16px; margin: 0; font-size: 12px;">
            @forelse($productShare['topProducts'] as $product)
                <li>
                    {{ $product['product_name'] }}: ₱{{ number_format($product['total'], 2) }}
                </li>
            @empty
                <li>No product data available</li>
            @endforelse
        </ul>
    </div>
    <div style="width: 100px; height: 100px;">
        <div id="productSalesDonut"></div>
    </div>
</div>

@php
    $labels = $productShare['labels'] ?? [];
    $data = $productShare['data'] ?? [];
    $colors = ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899'];

    if (empty($data)) {
        $labels = ['No Data'];
        $data = [1];
        $colors = ['#000'];
    }
@endphp
<script>
    window.productShareChartData = {
        labels: @json($labels),
        data: @json($data),
        colors: @json($colors),
        hasData: @json(!empty($productShare['data'])),
    };
</script>
<script src="{{ asset('script/admin/chart/product-share.js') }}"></script>
