@if (empty($revenueBreakdown['total']))
    <div class="text-center py-4">
        <img src="{{ asset('images/empty.gif') }}" alt="No data" style="width: 80px;">
        <p class="m-0 text-muted">No data yet.</p>
    </div>
@else
    <div>
        <h6 class="fw-bold">Sales Distribution</h6>
        <div class="d-flex justify-content-between align-items-center">
            @php
                $labels = $onlineVsWalkin['labels'] ?? ['Online','Walk-in'];
                $values = $onlineVsWalkin['data'] ?? [0,0];
                $total = array_sum($values);
                $colors = ['#36A2EB', '#FFA500'];
            @endphp

            <div class="me-3">
                @foreach($labels as $index => $label)
                    @php
                        $percentage = $total > 0 ? round(($values[$index] / $total) * 100, 1) : 0;
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
@endif
<script>
const ctxType = document.getElementById('onlineVsWalkinChart').getContext('2d');
new Chart(ctxType, {
    type: 'doughnut',
    data: {
        labels: @json($onlineVsWalkin['labels'] ?? ['Online','Walk-in']),
        datasets: [{
            data: @json($onlineVsWalkin['data'] ?? [0,0]),
            backgroundColor: ['#36A2EB', '#FFA500'],
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
            legend: false,
            tooltip: {
                callbacks: {
                    label: function(context) {
                        let dataset = context.dataset;
                        let total = dataset.data.reduce((sum, value) => sum + value, 0);
                        let value = context.raw;
                        let percentage = ((value / total) * 100).toFixed(1);
                        return `${context.label}: ₱${new Intl.NumberFormat().format(value)} (${percentage}%)`;
                    }
                }
            }
        }
    }
});
</script>
