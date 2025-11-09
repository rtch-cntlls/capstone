document.addEventListener('DOMContentLoaded', function () {
    if (typeof window.revenueChartData === 'undefined') return;

    const chartData = window.revenueChartData;
    const ctxRevenue = document.getElementById('revenueChart');

    if (!ctxRevenue) return;

    new Chart(ctxRevenue.getContext('2d'), {
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
});
