<div class="row px-2">
    <div class="col-md-12">
        <div class="card mb-4 p-3 ">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0">Product Sales Trends</h6>
                <form method="GET" id="salesTrendsFilterForm">
                    <select name="mode" class="form-select form-select-sm"
                        onchange="document.getElementById('salesTrendsFilterForm').submit()">
                        <option value="daily" {{ request('mode','daily') === 'daily' ? 'selected' : '' }}>Daily</option>
                        <option value="monthly" {{ request('mode') === 'monthly' ? 'selected' : '' }}>Monthly</option>
                        <option value="yearly" {{ request('mode') === 'yearly' ? 'selected' : '' }}>Yearly</option>
                    </select>        
                </form>
            </div>
            <div id="salesTrendsApex" style="height: 300px;"></div>
        </div>
    </div>    
</div> 
<script>
    const salesTrendsLabels = @json($salesTrends['labels']);
    const salesTrendsData   = @json($salesTrends['data']);
    const revenueTrendsData = @json($revenueTrends['data']);
</script>
<script src="{{ asset('script/admin/chart/sale-trends.js') }}"></script>
