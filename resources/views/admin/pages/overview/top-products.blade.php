<div class="col-md-6">
    <div class="card mb-4 p-3">
        <h6 class="fw-bold mb-0">Top Selling Products</h6>
        <div id="topProductsChart"></div>
    </div>
</div>
<script>
    var topProductsLabels = @json($topProducts['labels']);
    var topProductsData   = @json($topProducts['data']);
</script>
<script src="{{ asset('script/admin/chart/top-selling.js') }}"></script>
