@if (empty($weeklyServiceRevenue))
    <div class="text-center" style="font-size: 12px;">
        <img src="{{ asset('images/empty.gif') }}" alt="" style="width: 80px;">
        <p class="m-0">No service revenue.</p>
    </div>
@else
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div>
            <div class="mb-2 fw-bold" style="font-size:14px;">Weekly Service Revenue</div>
            <h5 class="p-2 bg-warning-subtle text-warning rounded mb-2">
                ₱{{ number_format($weeklyServiceRevenue, 2) }}
            </h5>    
        </div>
        <div class="m-0" style="width: 200px; height: 100px;">
            <div id="weeklyServiceRevenueMiniChart"></div>
        </div>
    </div>
@endif

@php
    $dailyRevenue = $dailyServiceRevenue ?? collect();
    $serviceLabels = $dailyRevenue->keys()->toArray();
    $serviceData = $dailyRevenue->values()->toArray();
@endphp

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var options = {
        chart: {
            type: 'bar',
            height: 100,
            width: '100%',
            toolbar: { show: false },
            sparkline: { enabled: true },
            animations: { enabled: true, easing: 'easeinout', speed: 500 }
        },
        series: [{
            name: 'Revenue',
            data: @json($serviceData)
        }],
        colors: ['#facc15'],
        plotOptions: {
            bar: {
                columnWidth: '60%',
                borderRadius: 3
            }
        },
        tooltip: {
            enabled: true,
            theme: 'light',
            x: {
                formatter: function(val) {
                    const dateObj = new Date(val);
                    return dateObj.toLocaleDateString('en-US', { weekday: 'short', month: 'short', day: 'numeric' });
                }
            },
            y: {
                formatter: function(val) {
                    return '₱' + (val >= 1000 ? (val/1000).toFixed(1) + 'K' : val.toFixed(2));
                }
            }
        },
        grid: { show: false },
        xaxis: { 
            categories: @json($serviceLabels),
            labels: { show: false },
            axisBorder: { show: false },
            axisTicks: { show: false }
        },
        yaxis: { show: false },
        responsive: [
            {
                breakpoint: 576,
                options: {
                    chart: { height: 80 },
                    plotOptions: { bar: { columnWidth: '70%' } }
                }
            }
        ]
    };

    var chart = new ApexCharts(document.querySelector("#weeklyServiceRevenueMiniChart"), options);
    chart.render();
});
</script>
