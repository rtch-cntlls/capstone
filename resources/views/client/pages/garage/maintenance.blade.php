@extends('client.layouts.clientNoFooter')
@section('content')
<div class="container">
    @include('client.pages.garage.includes.nav')
    @if($latestMaintenance)
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
