@if($logs->isEmpty())
<div class="text-center my-5">
    <img src="{{ asset('images/empty.gif') }}" alt="No Maintenance" style="width: 160px;" class="mb-3">
    <p class="m-0 fw-bold">No maintenance logs found for this motorcycle.</p>
</div>
@else
<div class="mt-3">
    <h6 class="fw-bold">Service History</h6>
    <div class="d-flex flex-column gap-3">
        @foreach($logs as $log)
            <div class="card border-0 shadow-sm position-relative">
                {{-- <form action="{{ route('admin.service-logs.maintenance-logs.refresh', $log) }}" method="POST" class="position-absolute" style="top:8px; left:8px; z-index:2;">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-light border fw-bold" title="Refresh AI"
                        style="line-height:1; width:28px; height:28px; padding:0; display:flex; align-items:center; justify-content:center;">
                        &#10227;
                    </button>
                </form> --}}
                {{-- <form action="{{ route('admin.service-logs.maintenance-logs.destroy', $log) }}" method="POST" class="position-absolute" style="top:8px; right:8px; z-index:2;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-light border fw-bold" title="Delete this history" style="line-height:1; width:28px; height:28px; padding:0; display:flex; align-items:center; justify-content:center;" onclick="event.stopPropagation(); return confirm('Delete this maintenance history entry?');">&times;</button>
                </form> --}}
                <div class="card-body p-3 p-md-4">
                    <div class="row gy-3">
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-circle bg-light-primary me-3">
                                    <i class="fas fa-cogs text-primary"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted small">Service Type</p>
                                    <h6 class="fw-bold mb-0">{{ $log->service->name ?? 'N/A' }}</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-circle bg-light-success me-3">
                                    <i class="fas fa-tachometer-alt text-success"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted small">Mileage at Service</p>
                                    <h6 class="fw-bold mb-0"> 
                                        {{ $log->mileage ? number_format($log->mileage).' km' : '-' }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-circle bg-light-info me-3">
                                    <i class="fas fa-calendar-alt text-info"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted small">Service Date</p>
                                    <h6 class="fw-bold mb-0">
                                        {{ $log->next_due_date ? \Carbon\Carbon::parse($log->service_date)->format('F j, Y') : '-' }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-circle bg-light-success me-3">
                                    <i class="fas fa-route"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted small">Next Due Mileage</p>
                                    <h6 class="fw-bold mb-0"> 
                                        {{ $log->next_due_mileage ? number_format($log->next_due_mileage).' km' : '-' }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="d-flex align-items-center">
                                <div class="icon-circle bg-light-info me-3">
                                    <i class="fas fa-calendar-check text-danger"></i>
                                </div>
                                <div>
                                    <p class="mb-0 text-muted small">Next Due Date</p>
                                    <h6 class="fw-bold mb-0">
                                        {{ $log->service_date ? \Carbon\Carbon::parse($log->next_due_date)->format('F j, Y') : '-' }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>               
                    <div class="mb-3">
                        <p class="mb-1 fw-medium small">AI Reasoning</p>
                        @if(is_array($log->ai_reasoning))
                            @foreach($log->ai_reasoning as $reason)
                                <p class="mb-1 small">{{ $reason }}</p>
                            @endforeach
                        @else
                            <p class="mb-1 small text-muted">{{ $log->ai_reasoning ?? 'No AI reasoning available.' }}</p>
                        @endif
                    </div>
                    <div>
                        @if($log->remarks)
                            <div class="mb-2">
                                <p class="mb-1 fw-medium small">Remarks</p>
                                <p class="mb-0 small text-muted">{{ $log->remarks }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
<div class="mt-3">
    {{ $logs->links('pagination::bootstrap-5') }}
</div>
@endif