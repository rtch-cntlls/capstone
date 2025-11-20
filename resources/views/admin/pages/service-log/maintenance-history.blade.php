@extends('admin.layouts.admin')
@section('content')
<div class="mt-2">
    <a href="{{ route('admin.service-logs.index')}}" class="text-decoration-none small text-muted">
        <i class="fas fa-arrow-left me-1"></i> Back
    </a>
</div>
<div class="px-2 position-relative">
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
                    <label class="form-label small mb-1">Email Address</label>
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
    @include('admin.pages.service-log.maintenance.current')
    @include('admin.pages.service-log.maintenance.history')
</div>
@include('admin.pages.service-log.new-service')
<script>
    (function () {
        const form = document.querySelector('#addMaintenanceModal form');
        const overlay = document.getElementById('aiLoadingOverlay');
        const roadSelect = document.getElementById('road_condition');
        const roadOther = document.getElementById('road_condition_other');
        const usageSelect = document.getElementById('usage_frequency');
        const usageOther = document.getElementById('usage_frequency_other');
        function toggleOther(selectEl, inputEl) {
            if (!selectEl || !inputEl) return;
            inputEl.classList.toggle('d-none', selectEl.value !== 'others');
            if (selectEl.value !== 'others') inputEl.value = '';
        }
        if (roadSelect && roadOther) {
            roadSelect.addEventListener('change', () => toggleOther(roadSelect, roadOther));
        }
        if (usageSelect && usageOther) {
            usageSelect.addEventListener('change', () => toggleOther(usageSelect, usageOther));
        }

        if (form && overlay) {
            form.addEventListener('submit', function () {
                overlay.classList.remove('d-none');
            });
        }
    })();
</script>
@endsection
