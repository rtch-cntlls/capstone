@if($latest)
<div class="card border-0 shadow-sm mb-3 position-relative">
    <div class="card-header bg-white py-3 px-4 d-flex justify-content-between align-items-center">
       <div>
        <form action="{{ route('admin.service-logs.maintenance-logs.refresh', $latest) }}" method="POST" class="position-absolute" style="top:8px; left:8px; z-index:2;">
            @csrf
            <button type="submit" class="btn btn-sm btn-light border fw-bold" title="Refresh AI"
                style="line-height:1; width:28px; height:28px; padding:0; display:flex; align-items:center; justify-content:center;">
                &#10227;
            </button>
        </form>
       </div>
        <div class="">
            <h6 class="mb-0 fw-bold"><i class="fas fa-tools me-2"></i> Latest Maintenance with AI Prediction</h6>
        </div>
    </div>
    <div class="card-body p-4">
        <div class="row gy-3">
            <div class="col-md-4 mb-3">
                <div class="d-flex align-items-center">
                    <div class="icon-circle bg-light-primary me-3">
                        <i class="fas fa-cogs text-primary"></i>
                    </div>
                    <div>
                        <p class="mb-0 text-muted small">Service Type</p>
                        <h6 class="fw-bold mb-0">{{ $latest->service->name ?? 'N/A' }}</h6>
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
                            {{ $latest->mileage ? number_format($latest->mileage).' km' : '-' }}
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
                            {{ $latest->service_date ? \Carbon\Carbon::parse($latest->service_date)->format('F j, Y') : '-' }}
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
                            {{ $latest->next_due_mileage ? number_format($latest->next_due_mileage).' km' : '-' }}
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
                            {{ $latest->next_due_date ? \Carbon\Carbon::parse($latest->next_due_date)->format('F j, Y') : '-' }}
                        </h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <h6 class="fw-bold mb-2">AI Maintenance Insights</h6>
            @if(is_array($latest->ai_reasoning))
                @foreach($latest->ai_reasoning as $reason)
                    <p class="mb-1 small">{{ $reason }}</p>
                @endforeach
            @else
                <p class="text-muted small">{{ $latest->ai_reasoning ?? 'No insights available.' }}</p>
            @endif
        </div>
        <hr class="my-3">
        <div class="row g-3 align-items-end">
            <div class="col-md-8">
                <form action="{{ route('admin.service-logs.maintenance-remarks.update', $latest) }}" method="POST" class="d-flex flex-column gap-1">
                    @csrf
                    <label for="latest_remarks" class="form-label fw-medium mb-1">Remarks</label>
                    <textarea id="latest_remarks" name="remarks" class="form-control" rows="2" placeholder="Add overall remarks for this motorcycle...">{{ old('remarks', $latest->remarks) }}</textarea>
                    <button type="submit" class="btn btn-sm btn-outline-primary align-self-start mt-2">Save Remarks</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif