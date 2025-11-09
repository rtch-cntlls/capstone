@extends('client.layouts.client')
@section('content')
<div class="container my-5">
    <div class="row g-4 align-items-center mb-5">
        <div class="col-lg-6 order-lg-2">
            <img src="{{ asset('storage/images/shop.jfif') }}" alt="{{ $shop->shop_name }}" class="img-fluid shadow-sm">
        </div>
        <div class="col-lg-6 order-lg-1">
            <h3 class="display-5 fw-bold mb-3">{{ $shop->shop_name }}</h3>
            <p class="lead text-muted mb-3">Your trusted motorcycle service and maintenance partner. We specialize in keeping your motorcycle in top condition with reliable service and quality parts.</p>
            <p class="text-muted">Our mission is simple: provide every rider with fast, affordable, and professional care, so you can enjoy a safe and smooth ride every day.</p>
        </div>
    </div>
    <div class="mb-5">
        <h3 class="fw-bold mb-3">About <span class="text-primary">Moto</span>Smart AI</h3>
        <p class="text-muted mb-4">MotoSmart AI is an intelligent motorcycle maintenance and service assistant, powered by <strong>Gemini AI Flash</strong>. It helps riders predict, prevent, and simplify motorcycle care.</p>
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <div class="col">
                <div class="d-flex gap-3 align-items-start">
                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 40px;">
                        <i class="fas fa-calendar-check fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Generate Service Schedules</h6>
                        <p class="text-muted mb-0">
                            Create a personalized service schedule for your motorcycle using the official maintenance service manual.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="d-flex gap-3 align-items-start">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 40px;">
                        <i class="fas fa-search fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Search Common Issues</h6>
                        <p class="text-muted mb-0">Identifies frequent problems for your motorcycle model so you know what to watch out for.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="d-flex gap-3 align-items-start">
                    <div class="bg-warning text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 40px;">
                        <i class="fas fa-tools fa-lg"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold mb-1">Basic Troubleshooting</h6>
                        <p class="text-muted mb-0">Provides step-by-step guides to fix minor issues at home before visiting a shop.</p>
                    </div>
                </div>
            </div>
        </div>

        <p class="mt-4 text-muted">Our mission is to empower every rider with smart technology to save time, reduce costs, and ensure safer rides on the road.</p>
    </div>
</div>
@endsection
