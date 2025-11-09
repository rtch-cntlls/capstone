document.addEventListener('DOMContentLoaded', function () {
    if (typeof window.productShareChartData === 'undefined') return;

    const chartData = window.productShareChartData;

    const options = {
        chart: {
            type: 'donut',
            height: 120,
            animations: { enabled: true, easing: 'easeinout', speed: 800 },
        },
        series: chartData.data,
        labels: chartData.labels,
        colors: chartData.colors,
        legend: { show: false },
        dataLabels: { enabled: false },
        responsive: [
            {
                breakpoint: 576,
                options: { chart: { height: 120 } }
            }
        ],
        plotOptions: {
            pie: {
                donut: {
                    size: '60%',
                    labels: { show: false }
                }
            }
        },
        tooltip: {
            enabled: chartData.hasData,
            theme: 'light',
            y: {
                formatter: function (val) {
                    return '₱' + (val >= 1000 ? (val / 1000).toFixed(1) + 'K' : val.toFixed(2));
                }
            }
        }
    };

    const chartElement = document.querySelector("#productSalesDonut");
    if (chartElement) {
        const chart = new ApexCharts(chartElement, options);
        chart.render();
    }
});
