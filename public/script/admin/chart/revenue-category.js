document.addEventListener('DOMContentLoaded', function () {
    if (typeof categoryRevenueLabels !== 'undefined' && typeof categoryRevenueData !== 'undefined') {
        var options = {
            chart: { type: 'pie', height: 290, toolbar: { show: true, tools: { download: true },
                export: { csv: { filename: "Category_Revenue_Share", headerCategory: "Category", headerValue: "Revenue" } }
            } },
            series: categoryRevenueData,
            labels: categoryRevenueLabels,
            colors: ['#1f2937', '#374151', '#4b5563', '#6b7280', '#9ca3af', '#111827'],
            tooltip: { y: { formatter: function(value) { return '₱' + value.toLocaleString(); } } }
        };

        new ApexCharts(document.querySelector("#categoryRevenueChart"), options).render();
    }
});
