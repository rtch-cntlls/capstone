@extends('admin.layouts.admin')
@section('content')
<div class="py-3 px-2 position-relative">
    <div class="d-flex justify-content-between align-items-center mb-3 mt-1 flex-wrap gap-2">
        <h4 class="fw-bold m-0">Maintenance History - {{ $baseLog->motorcycle_brand }} {{ $baseLog->motorcycle_model }}</h4>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addMaintenanceModal">
            <i class="bi bi-plus-lg"></i> Add New Service Log
        </button>
    </div>

    <div class="card border-0 shadow-sm mb-3">
        <div class="card-body py-2 px-3">
            <form action="{{ route('admin.service-logs.gmail.update', $baseLog) }}" method="POST" class="row g-2 align-items-center">
                @csrf
                <div class="col-md-4 col-12">
                    <label class="form-label small mb-1">Customer Name</label>
                    <input type="text" name="customer_name" value="{{ old('customer_name', $baseLog->customer_name) }}" class="form-control form-control-sm">
                </div>
                <div class="col-md-5 col-12">
                    <label class="form-label small mb-1">Gmail</label>
                    <input type="email" name="gmail" value="{{ old('gmail', $baseLog->gmail) }}" class="form-control form-control-sm" placeholder="name@gmail.com">
                </div>
                <div class="col-md-3 col-12 d-flex align-items-end">
                    <button type="submit" class="btn btn-sm btn-outline-primary ms-md-2 w-100 w-md-auto">Save Details</button>
                </div>
            </form>
        </div>
    </div>
    @isset($motors)
        @if($motors->count() > 0)
            <div class="mb-3">
                <div class="d-flex gap-2 flex-wrap">
                    @foreach($motors as $m)
                        @php
                            $isSelected = ($m->motorcycle_brand === $baseLog->motorcycle_brand) && ($m->motorcycle_model === $baseLog->motorcycle_model);
                            $brand = strtolower($m->motorcycle_brand ?? '');
                            $model = strtolower(str_replace(' ', '-', $m->motorcycle_model ?? ''));
                            $imagePath = "motorcycle/{$brand}/{$model}.webp";
                            $publicPath = public_path($imagePath);
                            $imgUrl = file_exists($publicPath) ? asset($imagePath) : asset('images/motorcycle.jpg');
                        @endphp
                        <div class="position-relative" style="width: 200px;">
                            <a href="{{ route('admin.service-logs.maintenance', $m) }}" class="text-decoration-none">
                                <div class="card border-0 shadow-sm {{ $isSelected ? 'ring ring-primary' : '' }} position-relative" style="width: 200px;">
                                    @if($isSelected)
                                        <span class="badge bg-primary position-absolute" style="top:6px; left:6px; z-index: 2;">Selected</span>
                                    @endif
                                    <div class="card-body p-2 d-flex flex-column align-items-center text-center">
                                        <div class="w-100" style="height: 120px; overflow: hidden; border-radius: 8px;">
                                            <img src="{{ $imgUrl }}" alt="{{ $m->motorcycle_brand }} {{ $m->motorcycle_model }}" style="width:100%;height:100%;object-fit:cover;display:block;">
                                        </div>
                                        <div class="mt-2">
                                            <div class="fw-bold small">{{ $m->motorcycle_brand }} {{ $m->motorcycle_model }}</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            {{-- <form id="del-motor-{{ $m->id }}" action="{{ route('admin.service-logs.motor.destroy', $m) }}" method="POST" class="position-absolute" style="top:6px; right:6px; z-index:3;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light border fw-bold" title="Delete motor" style="line-height:1; width:28px; height:28px; padding:0; display:flex; align-items:center; justify-content:center;" onclick="event.stopPropagation(); return confirm('Delete this motor and all its history?');">&times;</button>
                            </form> --}}
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    @endisset
    @if(session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif
    @if(session('warning'))
        <x-alert type="warning" :message="session('warning')" />
    @endif

    @php
        $latest = $logs->first();
    @endphp

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
                    <div class="col-md-6 mb-3">
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
                    <div class="col-md-6 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="icon-circle bg-light-success me-3">
                                <i class="fas fa-tachometer-alt text-success"></i>
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
                            <div class="d-flex justify-content-between flex-wrap gap-2 mb-2">
                                <div>
                                    <p class="mb-0 text-muted small">Service Type</p>
                                    <h6 class="fw-bold mb-0">{{ $log->service->name ?? 'N/A' }}</h6>
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
</div>

<div class="modal fade" id="addMaintenanceModal" tabindex="-1" aria-labelledby="addMaintenanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3 shadow-sm border-0">
            <form action="{{ route('admin.service-logs.maintenance-logs.store', $baseLog) }}" method="POST" class="p-3">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="addMaintenanceModalLabel">Add New Service Log</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-2">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Motorcycle</label>
                        <input type="text" class="form-control" name="motorcycle"
                            value="{{ $baseLog->motorcycle_brand }} {{ $baseLog->motorcycle_model }}" readonly>
                    </div>                    
                    <div class="mb-3">
                        <label for="last_service_type" class="form-label fw-medium">Service Type</label>
                       <select id="service_id" name="service_id" class="form-select" required>
                            <option value="">-- Select Service Type --</option>
                            @foreach($services as $service)
                                <option value="{{ $service->id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="last_mileage" class="form-label fw-medium">Mileage at Service (km)</label>
                        <input type="number" id="last_mileage" name="last_mileage" class="form-control form-control-lg" min="0" placeholder="Enter mileage">
                    </div>
                    <div class="mb-3">
                        <label for="last_service_date" class="form-label fw-medium">Service Date</label>
                        <input type="date" id="last_service_date" name="last_service_date" 
                               class="form-control form-control-lg" 
                               value="{{ old('last_service_date', date('Y-m-d')) }}" readonly>
                    </div>                    
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="submit" class="btn btn-primary btn-lg">Save & Run AI</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="aiLoadingOverlay" class="position-fixed top-0 start-0 w-100 h-100 d-none" style="background: rgba(255,255,255,0.8); z-index: 1055;">
    <div class="d-flex flex-column justify-content-center align-items-center h-100">
        <img src="{{ asset('images/generating.gif') }}" alt="Generating..." width="200" class="mb-3">
        <h6 class="fw-bold text-muted mb-1">AI is generating the next maintenance schedule...</h6>
        <p class="text-secondary small mb-0">Please wait, this may take a few seconds.</p>
    </div>
</div>
<script>
    (function () {
        const form = document.querySelector('#addMaintenanceModal form');
        const overlay = document.getElementById('aiLoadingOverlay');

        if (form && overlay) {
            form.addEventListener('submit', function () {
                overlay.classList.remove('d-none');
            });
        }
    })();
</script>
@endsection
