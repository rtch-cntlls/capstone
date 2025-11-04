@if (empty($productShare['topProducts']))
    <div class="text-center" style="font-size: 12px;">
        <img src="{{ asset('images/empty.gif') }}" alt="" style="width: 80px;">
        <p class="m-0">No item sold yet.</p>
    </div>
@else
    <div class="d-flex justify-content-between">
        <div class="me-3">
            <div class="mb-2 fw-bold">Product Market Share</div>
            <ul style="padding-left: 16px; margin: 0; font-size: 12px;">
                @foreach($productShare['topProducts'] as $product)
                    <li>
                        {{ $product['product_name'] }}: ₱{{ number_format($product['total'], 2) }}
                    </li>
                @endforeach
            </ul>
        </div>
        <div style="width: 100px; height: 100px;">
            <div id="productSalesDonut"></div>
        </div>
    </div>
@endif

@php
    $labels = $productShare['labels'] ?? [];
    $data = $productShare['data'] ?? [];
    $colors = ['#3b82f6', '#10b981', '#f59e0b', '#ef4444', '#8b5cf6', '#ec4899'];
@endphp

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var options = {
        chart: {
            type: 'donut',
            height: 120,
            animations: { enabled: true, easing: 'easeinout', speed: 800 },
        },
        series: @json($data),
        labels: @json($labels),
        colors: @json($colors),
        legend: { show: false },
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
            theme: 'light',
            y: {
                formatter: function(val) {
                    return '₱' + (val >= 1000 ? (val/1000).toFixed(1)+'K' : val.toFixed(2));
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#productSalesDonut"), options);
    chart.render();
});
</script>
