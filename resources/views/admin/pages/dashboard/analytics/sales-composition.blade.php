@if (empty($revenueBreakdown['total']))
    <div class="text-center" style="font-size: 12px;">
        <img src="{{ asset('images/empty.gif') }}" alt="" style="width: 80px;">
        <p class="m-0 text-muted">No data yet.</p>
    </div>
@else
    @php
        $labels = $revenueBreakdown['labels'] ?? ['Product', 'Service'];
        $values = $revenueBreakdown['data'] ?? [0, 0];
        $total = array_sum($values);
        $colors = ['#36A2EB','#32CD32'];
    @endphp
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <h6 class="fw-bold">Sales Composition</h6>
            <h6 class="fw-bold text-danger">₱{{ number_format($total, 2) }}</h6>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <div class="me-3">
                <div class="mt-2">
                    @foreach($labels as $index => $label)
                        @php
                            $percentage = $total > 0 ? round(($values[$index] / $total) * 100, 1) : 0;
                        @endphp
                        <div class="d-flex align-items-center mb-1">
                            <span class="me-2 rounded-circle"
                                  style="display:inline-block;width:14px;height:14px;background-color:{{ $colors[$index] }}">
                            </span>
                            <small class="text-muted">
                                {{ $label }}: <span class="fw-bold">{{ $percentage }}%</span>
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
@endif
<script>
const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
new Chart(ctxRevenue, {
    type: 'doughnut',
    data: {
        labels: @json($revenueBreakdown['labels']),
        datasets: [{
            data: @json($revenueBreakdown['data']),
            backgroundColor: ['#32CD32',' #008000'],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        rotation: -90,
        circumference: 180,
        cutout: '70%',
        plugins: {
            legend: { display: false },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let dataset = context.dataset.data;
                        let total = dataset.reduce((sum, value) => sum + value, 0);
                        let value = context.raw;
                        let percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                        return `${context.label}: ${percentage}%`;
                    }
                }
            }
        }
    }
});
</script>
