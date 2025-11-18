@extends('client.layouts.clientNoFooter')
@section('content')
<div class="container">
    @include('client.pages.garage.includes.nav')
    @if(isset($serviceLogs) && $serviceLogs->isNotEmpty())
        @php
            $latest = $serviceLogs->first();
        @endphp
        <div class="card border-0 shadow-sm overflow-hidden mb-3">
            <div class="card-header bg-white py-3 px-4">
                <h5 class="mb-0 fw-bold"><i class="fas fa-tools me-2"></i> Latest Maintenance Record</h5>
            </div>
            <div class="card-body p-4">
                <div class="row gy-3">
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-light-primary me-3">
                                <i class="fas fa-cogs text-primary"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-muted small">Service Type</p>
                                <h6 class="fw-bold mb-0">{{ $latest->last_service_type ?? 'N/A' }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-light-success me-3">
                                <i class="fas fa-tachometer-alt text-success"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-muted small">Mileage at Service</p>
                                <h6 class="fw-bold mb-0">{{ $latest->last_mileage ? number_format($latest->last_mileage).' km' : 'N/A' }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-light-warning me-3">
                                <i class="fas fa-road text-warning"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-muted small">Next Due Mileage</p>
                                <h6 class="fw-bold mb-0">
                                    {{ $latest->next_due_mileage ? number_format($latest->next_due_mileage).' km' : '-' }}
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-light-info me-3">
                                <i class="fas fa-calendar-alt text-info"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-muted small">Next Due Date</p>
                                <h6 class="fw-bold mb-0">
                                    {{ $latest->next_due_date ? \Carbon\Carbon::parse($latest->next_due_date)->format('F j, Y') : '-' }}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <h6 class="fw-bold mb-2">Maintenance Insights</h6>
                    @if(is_array($latest->ai_reasoning))
                        @foreach($latest->ai_reasoning as $reason)
                            <p class="mb-1 small">{{ $reason }}</p>
                        @endforeach
                    @else
                        <p class="text-muted small mb-1">{{ $latest->ai_reasoning ?? 'No insights available.' }}</p>
                    @endif

                    @if(!empty($latest->remarks))
                        <hr class="my-3">
                        <p class="mb-1 fw-medium small">Shop Remarks</p>
                        <p class="mb-0 small text-secondary">{{ $latest->remarks }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="mt-3">
            <h6 class="fw-bold mb-3">Service History</h6>
            <div class="d-flex flex-column gap-3">
                @foreach($serviceLogs as $log)
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-3 p-md-4">
                            <div class="d-flex justify-content-between flex-wrap gap-2 mb-2">
                                <div>
                                    <p class="mb-0 text-muted small">Service Type</p>
                                    <h6 class="fw-bold mb-0">{{ $log->last_service_type ?? 'N/A' }}</h6>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted small">Mileage at Service</p>
                                    <h6 class="fw-bold mb-0">{{ $log->last_mileage ? number_format($log->last_mileage).' km' : 'N/A' }}</h6>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted small">Service Date</p>
                                    <h6 class="fw-bold mb-0">{{ $log->last_service_date ? \Carbon\Carbon::parse($log->last_service_date)->format('M d, Y') : 'N/A' }}</h6>
                                </div>
                            </div>
                            <div class="d-flex justify-content-start flex-wrap gap-4 mb-3">
                                <div>
                                    <p class="mb-0 text-muted small">Next Due Mileage</p>
                                    <h6 class="fw-bold mb-0">{{ $log->next_due_mileage ? number_format($log->next_due_mileage).' km' : 'N/A' }}</h6>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted small">Next Due Date</p>
                                    <h6 class="fw-bold mb-0">{{ $log->next_due_date ? \Carbon\Carbon::parse($log->next_due_date)->format('M d, Y') : 'N/A' }}</h6>
                                </div>
                            </div>
                            <div class="mb-1">
                                <p class="mb-1 fw-medium small">AI Reasoning</p>
                                @if(is_array($log->ai_reasoning))
                                    @foreach($log->ai_reasoning as $reason)
                                        <p class="mb-1 small">{{ $reason }}</p>
                                    @endforeach
                                @else
                                    <p class="mb-1 small text-muted">{{ $log->ai_reasoning ?? 'No AI reasoning available.' }}</p>
                                @endif
                            </div>

                            @if(!empty($log->remarks))
                                <div class="mt-2">
                                    <p class="mb-1 fw-medium small">Shop Remarks</p>
                                    <p class="mb-0 small text-secondary">{{ $log->remarks }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @elseif($latestMaintenance)
        <div class="card border-0 shadow-sm overflow-hidden">
            <div class="card-header bg-white py-3 px-4">
                <h5 class="mb-0 fw-bold"><i class="fas fa-tools me-2"></i> Latest Maintenance Record</h5>
            </div>
            <div class="card-body p-4">
                <div class="row gy-3">
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-light-primary me-3">
                                <i class="fas fa-cogs text-primary"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-muted small">Service Type</p>
                                <h6 class="fw-bold mb-0">{{ $latestMaintenance->service_type }}</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-light-success me-3">
                                <i class="fas fa-tachometer-alt text-success"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-muted small">Mileage at Service</p>
                                <h6 class="fw-bold mb-0">{{ number_format($latestMaintenance->mileage_at_service) }} km</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-light-warning me-3">
                                <i class="fas fa-road text-warning"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-muted small">Next Due Mileage</p>
                                <h6 class="fw-bold mb-0">
                                    {{ $latestMaintenance->next_due_mileage ? number_format($latestMaintenance->next_due_mileage).' km' : '-' }}
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-light-info me-3">
                                <i class="fas fa-calendar-alt text-info"></i>
                            </div>
                            <div>
                                <p class="mb-0 text-muted small">Next Due Date</p>
                                <h6 class="fw-bold mb-0">
                                    {{ $latestMaintenance->next_due_date ? \Carbon\Carbon::parse($latestMaintenance->next_due_date)->format('F j, Y') : '-' }}
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <h6 class="fw-bold mb-2">Maintenance Insights</h6>
                    @if(is_array($latestMaintenance->ai_reasoning))
                            @foreach($latestMaintenance->ai_reasoning as $reason)
                                <p>{{ $reason }}</p>
                            @endforeach
                    @else
                        <p class="text-muted small">{{ $latestMaintenance->ai_reasoning ?? 'No insights available.' }}</p>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="text-center py-5 bg-white">
            <img src="{{ asset('images/garage.jpg') }}" alt="No Records" width="150" class="mb-3">
            <h6 class="fw-bold text-muted">No Maintenance Records Found</h6>
            <p class="text-secondary small">You haven’t logged any maintenance yet. Add one to get AI-based insights and reminders.</p>
        </div>
    @endif
</div>
@endsection
