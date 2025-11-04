<div class="p-4 card mb-4">
    <div class="d-flex justify-content-between align-items-center mb-2">
        <div class="fw-bold" style="font-size:14px;">Sold Products Progress</div>
        <div class="text-muted small">
            ₱{{ number_format($soldProductValue ?? 0, 2) }} / ₱{{ number_format($totalProductValue ?? 0, 2) }}
            ({{ $totalProductValue > 0 ? round(($soldProductValue / $totalProductValue) * 100, 1) : 0 }}%)
        </div>
    </div>
    <div id="soldProgressBar" style="height: 50px;"></div>
</div>

@php
    $totalValue = $totalProductValue ?? 0;
    $soldValue = $soldProductValue ?? 0;
    $soldPercent = $totalValue > 0 ? round(($soldValue / $totalValue) * 100, 1) : 0;
    $remainingPercent = 100 - $soldPercent;
@endphp

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var options = {
        chart: {
            type: 'bar',
            height: 80,
            stacked: true,
            toolbar: { show: false },
            sparkline: { enabled: true }
        },
        series: [
            { name: 'Sold', data: [@json($soldPercent)] },
            { name: 'Remaining', data: [@json($remainingPercent)] }
        ],
        plotOptions: {
            bar: { 
                horizontal: true, 
                borderRadius: 8, 
                barHeight: '60%' 
            }
        },
        colors: ['#1E3A8A', '#10B981'],
        xaxis: { 
            categories: [''], 
            max: 100,
            labels: { show: false },
            axisBorder: { show: false },
            axisTicks: { show: false }
        },
        yaxis: { show: false },
        dataLabels: { 
            enabled: true, 
            formatter: val => val + '%', 
            style: { colors: ['#fff'], fontSize: '13px' },
            dropShadow: { enabled: false }
        },
        grid: { show: false },
        legend: { show: false }
    };

    var chart = new ApexCharts(document.querySelector("#soldProgressBar"), options);
    chart.render();
});
</script>
