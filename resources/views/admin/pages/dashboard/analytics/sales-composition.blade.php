@php
    $labels = $revenueBreakdown['labels'] ?? ['Product', 'Service'];
    $values = $revenueBreakdown['data'] ?? [0, 0];
    $total = array_sum($values);
    $colors = ['#36A2EB','#32CD32'];

    $hasData = $total > 0;
    if (!$hasData) {
        $labels = ['No Data'];
        $values = [1];
        $colors = ['#000'];
    }
@endphp
<div>
    <div class="d-flex justify-content-between align-items-center">
        <h6 class="fw-bold">Sales Composition</h6>
        <h6 class="fw-bold">₱{{ number_format($total, 2) }}</h6>
    </div>
    <div class="d-flex justify-content-between align-items-center">
        <div class="me-3">
            <div class="mt-2">
                @foreach($labels as $index => $label)
                    @php
                        $percentage = $hasData && $total > 0 ? round(($values[$index] / $total) * 100, 1) : 0;
                    @endphp
                    <div class="d-flex align-items-center mb-1">
                        <span class="me-2 rounded-circle"
                              style="display:inline-block;width:14px;height:14px;background-color:{{ $colors[$index] }}">
                        </span>
                        <small class="text-muted">
                            {{ $label }}:
                            <span class="fw-bold">{{ $percentage }}%</span>
                        </small>
                    </div>
                @endforeach
            </div>
        </div>
        <div style="flex: 1; max-width: 220px; height: 200px;">
            <canvas id="revenueChart"></canvas>
        </div>
    </div>
</div>
<script>
    window.revenueChartData = {
        labels: @json($labels),
        data: @json($values),
        colors: @json($colors),
        hasData: @json($hasData),
    };
</script>
<script src="{{ asset('script/admin/chart/sales-composition.js') }}"></script>