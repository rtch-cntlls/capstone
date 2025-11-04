document.addEventListener('DOMContentLoaded', function () {
    if (typeof topProductsLabels !== 'undefined' && typeof topProductsData !== 'undefined') {
        var options = {
            chart: {
                type: 'bar',
                height: 278,
                toolbar: {
                    show: true,
                    tools: { download: true },
                    export: {
                        csv: {
                            filename: "Top_Products",
                            headerCategory: "Product Name",
                            headerValue: "Quantity Sold"
                        }
                    }
                }
            },
            series: [{ name: 'Quantity Sold', data: topProductsData }],
            colors: ['#1f2937'],
            plotOptions: { bar: { horizontal: true, barHeight: '50%' } },
            dataLabels: { enabled: false },
            xaxis: { categories: topProductsLabels, labels: { show: true } },
            yaxis: { labels: { show: false } },
            tooltip: { y: { formatter: function(value) { return value + ' units'; } } }
        };

        new ApexCharts(document.querySelector("#topProductsChart"), options).render();
    }
});
