document.addEventListener('DOMContentLoaded', function () {

    if (typeof salesTrendsLabels === 'undefined' || typeof salesTrendsData === 'undefined') return;

    const labels = salesTrendsLabels;
    const data   = salesTrendsData;

    const options = {
        chart: {
            type: 'area',
            height: 300,
            toolbar: {
                show: true,
                tools: {
                    download: true,
                    selection: false,
                    zoom: false,
                    zoomin: false,
                    zoomout: false,
                    pan: false,
                    reset: false
                },
                export: {
                    csv: {
                        filename: 'Sales_Trends',
                        headerCategory: 'Date',
                        headerValue: 'Sales',
                        formatter: function(seriesName, opts) {
                            const value = opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex];
                            return value.toLocaleString('en-PH', {
                                style: 'currency',
                                currency: 'PHP',
                                minimumFractionDigits: 0
                            });
                        }
                    }
                }
            },
            zoom: { enabled: false },
            animations: { enabled: true, easing: 'easeinout', speed: 800 }
        },
        series: [{ name: 'Sales', data }],
        xaxis: {
            categories: labels,
            labels: { style: { colors: '#6c757d', fontSize: '12px' } },
            axisBorder: { show: false },
            axisTicks: { show: false }
        },
        yaxis: {
            labels: {
                formatter: val => '₱' + new Intl.NumberFormat().format(val),
                style: { colors: '#6c757d', fontSize: '12px' }
            },
            min: 0
        },
        stroke: { curve: 'smooth', width: 2 },
        fill: {
            type: 'gradient',
            gradient: {
                shade: 'light',
                type: 'vertical',
                shadeIntensity: 0.5,
                gradientToColors: ['rgba(54,162,235,0.05)'],
                opacityFrom: 0.4,
                opacityTo: 0.05
            }
        },
        markers: {
            size: 4,
            colors: ['#36A2EB'],
            strokeColors: '#fff',
            strokeWidth: 2,
            hover: { size: 6 }
        },
        tooltip: {
            theme: 'light',
            y: { formatter: val => '₱' + new Intl.NumberFormat().format(val) }
        },
        grid: { borderColor: '#e0e0e0', row: { colors: ['transparent'], opacity: 0.5 } }
    };

    const chart = new ApexCharts(document.querySelector("#salesTrendsApex"), options);
    chart.render();

    const downloadBtn = document.getElementById('downloadSalesChart');
    if (downloadBtn) {
        downloadBtn.addEventListener('click', function () {
            chart.dataURI().then(uri => {
                const link = document.createElement('a');
                link.href = uri.imgURI;
                link.download = 'Sales_Trends.png';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            });
        });
    }
});
