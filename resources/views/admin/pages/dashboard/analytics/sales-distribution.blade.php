<div>
    <h6 class="fw-bold">Sales Distribution</h6>
    <div class="d-flex justify-content-between align-items-center">
        @php
            $labels = $onlineVsWalkin['labels'] ?? ['Online','Walk-in'];
            $values = $onlineVsWalkin['data'] ?? [0,0];
            $total = array_sum($values);
            $colors = ['#36A2EB', '#FFA500'];

            $hasData = $total > 0;
            if (!$hasData) {
                $labels = ['No Data'];
                $values = [1];
                $colors = ['#000'];
            }
        @endphp

        <div class="me-3">
            @foreach($labels as $index => $label)
                @php
                    $percentage = $hasData && $total > 0 ? round(($values[$index] / $total) * 100, 1) : 0;
                @endphp
                <div class="d-flex align-items-center mb-2">
                    <span class="me-2 rounded-circle" 
                          style="display:inline-block;width:14px;height:14px;background-color:{{ $colors[$index] }};">
                    </span>
                    <small class="text-muted">
                        {{ $label }}: 
                        <span class="fw-bold">{{ $percentage }}%</span>
                    </small>
                </div>
            @endforeach
        </div>

        <div style="flex: 1; max-width: 220px; height: 200px;">
            <canvas id="onlineVsWalkinChart"></canvas>
        </div>
    </div>
</div>
<script>
    window.onlineVsWalkinChartData = {
        labels: @json($labels),
        data: @json($values),
        colors: @json($colors),
        hasData: @json($hasData),
    };
</script>
<script src="{{ asset('script/admin/chart/sales-distribution.js') }}"></script>
