@if (empty($weeklySales))
    <div class="text-center py-4" style="font-size: 12px;">
        <img src="{{ asset('images/empty.gif') }}" alt="" style="width: 80px;">
        <p class="m-0 text-muted">No product sales.</p>
    </div>
@else
    <div class="d-flex justify-content-between align-items-center mb-3">
        <div>
            <div class="mb-2 fw-bold" style="font-size:14px;">Weekly Product Sales</div>
            <h5 class="p-2 bg-success-subtle text-success rounded shadow-sm">
                ₱{{ number_format($weeklySales, 2) }}
            </h5>    
        </div>
        <div id="weeklySalesApex" style="width: 220px; height: 100px;"></div>
    </div>
@endif

@php
    $labels = $dailySales->keys()->toArray() ?? [];
    $data = $dailySales->values()->toArray() ?? [];
@endphp

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var options = {
        chart: {
            type: 'bar',
            height: 100,
            sparkline: { enabled: true },
            animations: { enabled: true, easing: 'easeinout', speed: 600 }
        },
        series: [{
            name: 'Sales',
            data: @json($data)
        }],
        plotOptions: {
            bar: {
                borderRadius: 4,
                horizontal: false,
                columnWidth: '50%',
                colors: {
                    ranges: [{
                        from: 0,
                        to: 1000000,
                        color: '#2563eb'
                    }]
                }
            }
        },
        tooltip: {
            theme: 'light',
            x: {
                formatter: function(val, opts) {
                    let dateObj = new Date(val);
                    return dateObj.toLocaleDateString('en-US', { weekday: 'short' });
                }
            },
            y: {
                formatter: function(val) {
                    return '₱' + (val >= 1000 ? (val/1000).toFixed(1) + 'K' : val);
                }
            }
        },
        grid: { show: false },
        xaxis: { categories: @json($labels), labels: { show: false }, axisTicks: { show: false }, axisBorder: { show: false } },
        yaxis: { show: false }
    };

    var chart = new ApexCharts(document.querySelector("#weeklySalesApex"), options);
    chart.render();
});
</script>
