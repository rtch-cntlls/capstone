<div class="card mb-4 p-3">
    <h6 class="fw-bold mb-2">Monthly Revenue Trend</h6>
    <p class="text-muted mb-3">
        <strong>Highest Month:</strong> {{ $monthlyRevenueChart['highestMonth'] }} 
        — ₱{{ number_format($monthlyRevenueChart['highestRevenue'], 2) }}
    </p>
    <div id="monthlyRevenueChart"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const options = {
        chart: {
            type: 'area',
            height: 300,
            toolbar: { show: false },
            zoom: { enabled: false },
            animations: { enabled: true, easing: 'easeinout', speed: 700 }
        },
        stroke: {
            curve: 'smooth',
            width: 3
        },
        series: [{
            name: 'Monthly Revenue (₱)',
            data: @json($monthlyRevenueChart['data'])
        }],
        xaxis: {
            categories: @json($monthlyRevenueChart['labels']),
            labels: {
                style: { colors: '#6c757d', fontSize: '12px' }
            },
            axisBorder: { show: false },
            axisTicks: { show: false }
        },
        yaxis: {
            labels: {
                formatter: function (val) {
                    return '₱ ' + val.toLocaleString();
                },
                style: { colors: '#6c757d', fontSize: '12px' }
            }
        },
        fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 1,
                opacityFrom: 0.4,
                opacityTo: 0.05,
                stops: [0, 100]
            }
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return '₱ ' + val.toLocaleString();
                }
            }
        },
        colors: ['#36A2EB'],
        markers: {
            size: 4,
            colors: ['#36A2EB'],
            strokeColors: '#fff',
            strokeWidth: 2,
            hover: { size: 7 }
        },
        grid: {
            borderColor: 'rgba(200, 200, 200, 0.2)',
            strokeDashArray: 3,
            yaxis: { lines: { show: true } },
            xaxis: { lines: { show: false } }
        }
    };

    const chart = new ApexCharts(document.querySelector("#monthlyRevenueChart"), options);
    chart.render();
});
</script>
