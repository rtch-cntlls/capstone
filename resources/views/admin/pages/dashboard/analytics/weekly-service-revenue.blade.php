<div class="d-flex justify-content-between align-items-center flex-wrap">
    <div>
        <div class="mb-2 fw-bold" style="font-size:14px;">Weekly Service Revenue</div>
        <h5 class="p-2 fw-bold mb-2">
            ₱{{ number_format($weeklyServiceRevenue, 2) }}
        </h5>    
    </div>
    <div class="m-0" style="width: 200px; height: 100px;">
        <div id="weeklyServiceRevenueMiniChart"></div>
    </div>
</div>

@php
    $dailyRevenue = $dailyServiceRevenue ?? collect();
    $serviceLabels = $dailyRevenue->keys()->toArray();
    $serviceData = $dailyRevenue->values()->toArray();
@endphp

<script>
    window.weeklyServiceRevenueData = {
        labels: @json($serviceLabels),
        data: @json($serviceData)
    };
</script>
<script src="{{ asset('script/admin/chart/weekly-service.js') }}"></script>