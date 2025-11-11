@extends('client.layouts.client')
@section('content')
@include('components.ModalAlertSuccess')
@include('components.ModalAlertError')
<div class="container">
    <h4 class="fw-bold mb-4">Available Services</h4>
    <div class="row g-3">
        @forelse($services as $service)
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-sm h-100 border-0 hover-shadow d-flex flex-column">
                    <img src="{{ asset('images/services.webp') }}" class="card-img-top" alt="{{ $service->name }}" style="height: 180px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <div class="mb-3">
                            <h5 class="fw-bold mb-1">{{ $service->name }}</h5>
                            <small class="text-success">{{ $service->category ?? 'General' }}</small>
                        </div>
                        <div class="flex-grow-1"></div>
                        <div class=" mb-3">
                            <p class="mb-1"><small class="text-muted">Estimated Duration: {{ $service->duration ?? 'N/A' }}</small></p>
                            <p class="fw-bold text-danger mb-0">₱{{ number_format($service->price, 2) }}</p>
                        </div>
                        <div class="mt-auto text-end">
                            <a href="{{ route('shop-services.CreateBooking', $service->service_id) }}" 
                                class="btn btn-success btn-sm shadow-sm">
                                <i class="fa fa-calendar-check me-1"></i> Book Now
                            </a>                             
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="text-muted mb-0">No services available at the moment.</p>
            </div>
        @endforelse
    </div>
    <div class="mt-4">
        {{ $services->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
