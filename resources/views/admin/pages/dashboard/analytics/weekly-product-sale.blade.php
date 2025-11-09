<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <div class="mb-2 fw-bold" style="font-size:14px;">Weekly Product Sales</div>
        <h5 class="p-2 fw-bold">
            ₱{{ number_format($weeklySales, 2) }}
        </h5>    
    </div>
    <div id="weeklySalesApex" style="width: 220px; height: 100px;"></div>
</div>

@php
    $labels = $dailySales->keys()->toArray() ?? [];
    $data = $dailySales->values()->toArray() ?? [];

    $hasData = !empty(array_filter($data));
    if (!$hasData) {
        $labels = ['No Data'];
        $data = [0];
    }
@endphp
<script>
    window.weeklySalesChartData = {
        labels: @json($labels),
        data: @json($data),
        hasData: @json($hasData),
    };
</script>
<script src="{{ asset('script/admin/chart/weekly-product.js') }}"></script>