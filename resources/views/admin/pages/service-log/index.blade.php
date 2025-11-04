@extends('admin.layouts.admin')
@section('content')
@include('admin.pages.service-log.create')
<div class="py-3 px-2">
    <div class="d-flex justify-content-between align-items-center mb-3 mt-1 flex-wrap gap-2">
        <h4 class="fw-bold m-0">Service Logs</h4>
        <div class="d-flex gap-2 flex-wrap">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#logServiceModal">
                <i class="bi bi-plus-lg"></i> Log New Service
            </button>
            <div class="dropdown">
                <button class="btn btn-white border border-dark dropdown-toggle ms-2" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 12px;">
                    <i class="fas fa-file-export me-1"></i>
                    <span class="fw-bold">Export</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="exportDropdown" style="font-size: 13px;">
                    <li>
                        <a class="dropdown-item d-flex align-items-center" 
                           href="{{ route('admin.service-logs.index', array_merge(request()->query(), ['export' => 'pdf'])) }}">
                            <i class="fas fa-file-pdf text-danger me-2"></i> Export as PDF
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" 
                           href="{{ route('admin.service-logs.index', array_merge(request()->query(), ['export' => 'csv'])) }}">
                            <i class="fas fa-file-csv text-success me-2"></i> Export as CSV
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    @if(session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif
    <form id="filterForm" method="GET" action="{{ route('admin.service-logs.index') }}" class="row g-2 mb-3 align-items-center">
        <div class="col-md-4">
            <input type="text" class="form-control auto-filter" placeholder="Search by name or contact" name="search" value="{{ request('search') }}">
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control" name="date_range" id="dateRange" placeholder="Select date range" value="{{ request('from') && request('to') ? request('from').' - '.request('to') : '' }}">
            <input type="hidden" name="from" id="from">
            <input type="hidden" name="to" id="to">
        </div>
        <div class="col-md-2">
            <a href="{{ route('admin.service-logs.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-sync-alt me-1"></i> Reset
            </a>
        </div>
    </form>
    @if ($logs->isEmpty())
        <div class="text-center my-5">
            <img src="{{ asset('images/empty.gif') }}" alt="No Orders" style="width: 160px;" class="mb-3">
            <p class="m-0 fw-bold">No service logs found.</p>
        </div>
    @else
        <div class="table-responsive table-wrapper">
            <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                <thead class="table-light">
                    <tr>
                        <th>Customer Name</th>
                        <th>Contact Number</th>
                        <th>Service</th>
                        <th>(₱) Generated</th>
                        <th>Date / Time</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->customer_name ?? 'N/A' }}</td>
                            <td>{{ $log->contact_number ?? 'N/A' }}</td>
                            <td>{{ $log->service->name ?? 'N/A' }}</td>
                            <td>{{ $log->service->price ? number_format($log->service->price, 2) : 'N/A' }}</td>
                            <td>{{ $log->created_at->format('M. d, y (h:i A)') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{ $logs->links() }}
            </div>
        </div>
    @endif
</div>
<script>
    window.defaultFrom = "{{ request('from') ?? now()->startOfMonth()->format('Y-m-d') }}";
    window.defaultTo   = "{{ request('to') ?? now()->format('Y-m-d') }}";
</script>
<script src="{{ asset('script/admin/filter.js')}}"></script>
@endsection
