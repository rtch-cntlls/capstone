document.addEventListener('DOMContentLoaded', function () {
    const chartElement = document.querySelector("#weeklyServiceRevenueMiniChart");
    const chartData = window.weeklyServiceRevenueData || { labels: [], data: [] };

    if (!chartElement || !chartData.data.length || chartData.data.every(v => v === 0)) {
        chartElement.innerHTML = `
            <div class="d-flex justify-content-center align-items-center text-muted" 
                 style="height:100%;font-size:12px;">
                 No data
            </div>`;
        return;
    }

    const options = {
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
            data: chartData.data
        }],
        colors: ['#facc15'],
        plotOptions: {
            bar: {
                columnWidth: '60%',
                borderRadius: 3
            }
        },
        tooltip: {
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
            categories: chartData.labels,
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

    const chart = new ApexCharts(chartElement, options);
    chart.render();
});
