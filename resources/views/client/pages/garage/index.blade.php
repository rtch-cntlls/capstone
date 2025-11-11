@extends('client.layouts.clientNoFooter')
@section('content')
@include('components.ModalAlertSuccess')
@include('components.ModalAlertError')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('client.partials.accountnav')
        </div>
        <div class="col-md-9">
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    <h4 class="fw-bold mb-1">My Motorcycles</h4>    
                </div>
                @if ($motorcycles->isNotEmpty())
                    <button type="button" class="btn btn-primary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#motorcycleModal">
                        <i class="fas fa-plus me-2"></i> Add Motorcycle
                    </button>
                @endif
            </div>
            @if($motorcycles->isEmpty())
                <div class="text-center py-5 bg-white border rounded shadow-sm my-3">
                    <img src="{{ asset('images/garage.jpg') }}" alt="No motorcycles" width="120">
                    <h5 class="fw-semibold mb-2">No Motorcycles Registered</h5>
                    <p class="text-muted mb-3">You haven't added any motorcycles yet. Click below to add your first one.</p>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#motorcycleModal">
                        Add Motorcycle
                    </button>
                </div>
            @else
                <div class="row g-3 mt-2">
                    @foreach($motorcycles as $motorcycle)
                        @php
                            $brand = strtolower($motorcycle->brand);
                            $model = strtolower(str_replace(' ', '-', $motorcycle->model));
                            $imagePath = "motorcycle/{$brand}/{$model}.webp";
                            $publicPath = public_path($imagePath);
                        @endphp
                        <div class="col-md-6 col-lg-4">
                            <a href="{{ route('garage.show', $motorcycle->motorcycle_id) }}" class="text-decoration-none">
                                <div class="card border-0 shadow-sm rounded-3 h-100 hover-shadow">
                                    @if(file_exists($publicPath))
                                        <img src="{{ asset($imagePath) }}" 
                                            alt="{{ $motorcycle->model }}" 
                                            class="card-img-top" 
                                            style="height:180px; width:100%; object-fit:cover;">
                                    @else
                                        <img src="{{ asset('images/motorcycle.jpg') }}" 
                                            alt="{{ $motorcycle->model }}" 
                                            class="card-img-top" 
                                            style="height:180px; width:100%; object-fit:cover;">
                                    @endif
                                    <div class="card-body text-center">
                                        <h5 class="fw-semibold mb-1">{{ $motorcycle->brand }}</h5>
                                        <p class="small mb-1">{{ $motorcycle->model }}</p>
                                        <a href="{{ route('garage.show', $motorcycle->motorcycle_id) }}" class="btn btn-outline-primary btn-sm rounded-pill w-100 px-3 me-1">
                                            View
                                        </a>
                                    </div>
                                </div>
                            </a>
                        </div>                                   
                    @endforeach
                </div>
                <div class="mt-4 d-flex justify-content-center">
                    {{ $motorcycles->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>
@include('client.pages.garage.modal-form.motorcycle')
@endsection
