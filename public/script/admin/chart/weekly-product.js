document.addEventListener('DOMContentLoaded', function () {
    if (typeof window.weeklySalesChartData === 'undefined') return;

    const chartData = window.weeklySalesChartData;
    const chartElement = document.querySelector("#weeklySalesApex");
    if (!chartElement) return;

    const hasData = chartData.hasData;
    const barColor = hasData ? '#2563eb' : '#e5e7eb';

    const options = {
        chart: {
            type: 'bar',
            height: 100,
            sparkline: { enabled: true },
            animations: { enabled: true, easing: 'easeinout', speed: 600 }
        },
        series: [{
            name: 'Sales',
            data: chartData.data
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
                        color: barColor
                    }]
                }
            }
        },
        tooltip: {
            enabled: hasData,
            theme: 'light',
            x: {
                formatter: function (val, opts) {
                    if (!hasData) return '';
                    return val;
                }
            },
            y: {
                formatter: function (val) {
                    if (!hasData) return '';
                    return '₱' + (val >= 1000 ? (val / 1000).toFixed(1) + 'K' : val);
                }
            }
        },
        grid: { show: false },
        xaxis: {
            categories: chartData.labels,
            labels: { show: false },
            axisTicks: { show: false },
            axisBorder: { show: false }
        },
        yaxis: { show: false }
    };

    const chart = new ApexCharts(chartElement, options);
    chart.render();
});
