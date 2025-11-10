@extends('client.layouts.clientNoFooter')
@section('content')
@php
    $maintenanceOverview = $maintenance['overview'] ?? '';
    $maintenanceSchedule = $maintenance['schedule'] ?? [];
@endphp
<div class="container">
    @include('client.pages.garage.includes.nav')
    @if($maintenanceOverview === '' && empty($maintenanceSchedule))
        <div class="text-center py-5 bg-white">
            <img src="{{ asset('storage/images/generating.gif') }}" alt="Generating..." width="200" class="mb-3">
            <h6 class="fw-bold text-muted mb-2">Analyzing Your Motorcycle Data</h6>
            <p class="text-secondary small mb-0">
                Please wait while Gemini AI generates your personalized maintenance plan...
            </p>
        </div>
    @else
        <div class="card border-0 shadow-sm mb-4">
            <div class="card-header bg-white py-3 px-4 d-flex align-items-center">
                <i class="fas fa-motorcycle me-2 fs-5"></i>
                <h5 class="mb-0 fw-bold">Motorcycle Overview</h5>
            </div>
            <div class="card-body p-4">
                <p class="text-muted mb-0" style="line-height: 1.7;">
                    {{ $maintenanceOverview !== '' ? $maintenanceOverview : 'No overview available for this motorcycle.' }}
                </p>
            </div>
        </div>
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white d-flex align-items-center py-3 px-4">
                <h5 class="mb-0">Recommended Maintenance Schedule</h5>
            </div>
            <div class="card-body p-4">
                @if(!empty($maintenanceSchedule))
                    <div class="row g-3">
                        @foreach($maintenanceSchedule as $index => $task)
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="card border-0 shadow-sm rounded-3 h-100 hover-card">
                                    <div class="card-body">
                                        <div class="d-flex align-items-start">
                                            <div class="icon-circle bg-light-primary me-3">
                                                <i class="fas fa-wrench text-dark"></i>
                                            </div>
                                            <div>
                                                <h6 class="fw-bold mb-1">{{ $task['task'] ?? 'Unnamed Task' }}</h6>
                                                <p class="text-muted small mb-0">
                                                    <i class="fas fa-clock me-1"></i>{{ $task['interval'] ?? '-' }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <img src="{{ asset('storage/images/empty-schedule.svg') }}" alt="No Schedule" width="120" class="mb-3">
                        <h6 class="fw-bold text-muted">No Maintenance Schedule Available</h6>
                        <p class="text-secondary small mb-0">
                            Once MotoSmart AI collects more data, it will generate a recommended schedule for you.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    @endif
</div>

@if($maintenanceOverview === '' && empty($maintenanceSchedule))
<script>
    setTimeout(() => location.reload(), 10000);
</script>
@endif
@endsection
