@extends('admin.layouts.admin')
@section('content')
<div class="py-3 px-2">
    <div class="row mt-3">
        <div class="col-md-12 d-flex justify-content-between align-items-center flex-wrap">
            <h4 class="fw-bold mb-2 mb-md-0">Service Report</h4>
            <div class="dropdown">
                <button class="btn btn-white border border-dark dropdown-toggle ms-2" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 12px;">
                    <i class="fas fa-file-export me-1"></i>
                    <span class="fw-bold">Export</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="exportDropdown" style="font-size: 13px;">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" 
                           href="{{ route('admin.service-report.export.pdf', ['from' => $from, 'to' => $to]) }}">
                            <i class="fas fa-file-pdf text-danger me-2"></i> Export as PDF
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" 
                           href="{{ route('admin.service-report.export.csv', ['from' => $from, 'to' => $to]) }}">
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
                    <a href="{{ route('admin.service-report.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-sync-alt me-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>
        <div class="col-md-12">
            <div class="card border-0 shadow-sm p-3">
                <canvas id="serviceTrendChart" height="320"></canvas>
            </div>
        </div>
        <div class="col-md-12 mt-4 mb-3">
            <div class="card border-0 shadow-sm p-3">
                <h5 class="mb-3 fw-bold">Completed Services</h5>
                <div class="table-responsive table-wrapper">
                    <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                        <thead class="table-light">
                            <tr>
                                <th></th>
                                <th>Date</th>
                                <th>Customer Name</th>
                                <th>Service</th>
                                <th>(₱) Generated</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $combined = $bookings->concat($logs)->sortBy(function($item) {
                                    return $item->schedule ?? $item->created_at;
                                });
                            @endphp
                        
                            @forelse($combined as $index => $entry)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($entry->schedule ?? $entry->created_at)->format('F d, Y') }}</td>
                                    <td>
                                        {{ trim(($entry->customer?->user?->firstname ?? '') . ' ' . ($entry->customer?->user?->lastname ?? '')) ?: ($entry->customer_name ?? 'N/A') }}
                                    </td>
                                    <td>{{ $entry->service->name ?? 'N/A' }}</td>
                                    <td>{{ $entry->service->price ?? 'N/A' }}</td>
                                    <td>{{ $entry instanceof \App\Models\Booking ? 'Booking' : 'Walk-in' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">No services found for this date range.</td>
                                </tr>
                            @endforelse
                        </tbody>                        
                    </table>
                    <div class="mt-3">
                        {{ $bookings->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    const dailyTrends = @json($dailyTrends);
</script>
<script src="{{ asset('script/admin/date-format.js') }}"></script>
<script src="{{ asset('script/admin/chart/service-report.js') }}"></script>
@endsection
