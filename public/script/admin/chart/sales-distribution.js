document.addEventListener('DOMContentLoaded', function () {
    if (typeof window.onlineVsWalkinChartData === 'undefined') return;

    const chartData = window.onlineVsWalkinChartData;
    const ctxType = document.getElementById('onlineVsWalkinChart');

    if (!ctxType) return;

    new Chart(ctxType.getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: chartData.labels,
            datasets: [{
                data: chartData.data,
                backgroundColor: chartData.colors,
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
                    enabled: chartData.hasData,
                    callbacks: {
                        label: function (context) {
                            const dataset = context.dataset;
                            const total = dataset.data.reduce((sum, value) => sum + value, 0);
                            const value = context.raw;
                            const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                            return `${context.label}: ₱${new Intl.NumberFormat().format(value)} (${percentage}%)`;
                        }
                    }
                }
            }
        }
    });
});
