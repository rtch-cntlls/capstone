@extends('admin.layouts.admin')
@section('content')
<div class="py-3 px-2">
    <div class="row mt-3">
        <div class="col-md-12 d-flex justify-content-between align-items-center flex-wrap">
            <h4 class="fw-bold mb-2 mb-md-0">Sales Report</h4>
            <div class="dropdown">
                <button class="btn btn-white border border-dark dropdown-toggle ms-2" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 12px;">
                    <i class="fas fa-file-export me-1"></i>
                    <span class="fw-bold">Export</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="exportDropdown" style="font-size: 13px;">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{  route('admin.sale-report.export.pdf', ['from' => $from, 'to' => $to]) }}">
                            <i class="fas fa-file-pdf text-danger me-2"></i> Export as PDF
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.sale-report.export.csv', ['from' => $from, 'to' => $to])}}">
                            <i class="fas fa-file-csv text-success me-2"></i> Export as CSV
                        </a>
                    </li>
                </ul>
            </div>           
        </div>
        <div class="mb-3">
            <form method="GET" id="filterForm" class="d-flex flex-wrap align-items-end gap-3">
                <div class="d-flex flex-column">
                    <label for="fromDate" class="form-label fw-semibold small text-secondary mb-1">From</label>
                    <input type="text" name="from" id="fromDate" value="{{ $from }}" class="form-control form-control-sm" 
                           placeholder="Start date" autocomplete="off">
                </div>
                <div class="d-flex flex-column">
                    <label for="toDate" class="form-label fw-semibold small text-secondary mb-1">To</label>
                    <input type="text" name="to" id="toDate" value="{{ $to }}" class="form-control form-control-sm" 
                        placeholder="End date" autocomplete="off">
                </div>
                <div class="d-flex align-items-end gap-2">
                    <button type="submit" class="btn btn-dark btn-sm">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <a href="{{ route('admin.sale-report.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-sync-alt me-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <div class="card border-0 shadow-sm p-3">
                <canvas id="salesLineChart" height="300"></canvas>
            </div>
        </div>
        <div class="col-md-12 mt-4 mb-3">
            <div class="card border-0 shadow-sm p-3">
                <h6 class="fw-bold mb-3">Products Sold ({{ \Carbon\Carbon::parse($from)->format('F j, Y') }} - {{ \Carbon\Carbon::parse($to)->format('F j, Y') }})</h6>
                <div class="table-responsive table-wrapper">
                    <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                        <thead class="table-light">
                            <tr>
                                <th></th>
                                <th>Product Name</th>
                                <th class="text-center">QTY Sold</th>
                                <th class="text-center">Sale Price</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($productsSold as $index => $product)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $product['name'] }}</td>
                                    <td class="text-center">{{ $product['total_sold'] }}</td>
                                    <td class="text-center">₱{{ number_format($product['avg_price'], 2) }}</td>
                                    <td class="text-end fw-semibold">₱{{ number_format($product['total_revenue'], 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted">No sales found for this date range.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-2">
                        {{ $productsSold->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var salesLabels  = @json($sales->pluck('date'));
    var salesRevenue = @json($sales->pluck('sales'));
</script>
<script src="{{ asset('script/admin/chart/sale-report.js') }}"></script>
<script src="{{ asset('script/admin/date-format.js') }}"></script>
@endsection