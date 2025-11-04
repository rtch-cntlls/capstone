<div class="col-md-6">
    <div class="card mb-4 p-3">
        <h6 class="fw-bold mb-0">Category Revenue Share</h6>
        <div id="categoryRevenueChart"></div>
    </div>
</div>
<script>
    var categoryRevenueLabels   = @json($categoryRevenue['labels']);
    var categoryRevenueData     = @json($categoryRevenue['data']);
</script>
<script src="{{ asset('script/admin/chart/revenue-category.js') }}"></script>