@extends('client.layouts.client')
@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">Contact Us</h2>
        <p class="text-muted">We’d love to hear from you. Reach out anytime!</p>
    </div>
    <div class="row g-4 justify-content-center">
        <div class="col-md-4 col-sm-6">
            <div class="card h-100 text-center border-0 shadow-sm rounded-3 p-4">
                <div class="card-body">
                    <div class="mb-3 text-primary fs-5">
                        <i class="fas fa-home"></i>
                    </div>
                    <h6 class="fw-bold">Visit Us</h6>
                    <p class="text-muted small mb-1">Our Address</p>
                    <p class="mb-0">{{ $shop->barangay ?? 'N/A' }}, {{ $shop->city ?? 'N/A'}}, {{ $shop->province ?? 'N/A'}}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="card h-100 text-center border-0 shadow-sm rounded-3 p-4">
                <div class="card-body">
                    <div class="mb-3 text-success fs-5">
                        <i class="fas fa-phone"></i>
                    </div>
                    <h6 class="fw-bold">Call Us</h6>
                    <p class="text-muted small mb-1">Mobile Number</p>
                    <p class="mb-0">0912-345-6789</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-6">
            <div class="card h-100 text-center border-0 shadow-sm rounded-3 p-4">
                <div class="card-body">
                    <div class="mb-3 text-danger fs-5">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h6 class="fw-bold">Email Us</h6>
                    <p class="text-muted small mb-1">Email Address</p>
                    <p class="mb-0">{{ $adminEmail ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
