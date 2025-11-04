@extends('client.layouts.client')
@section('content')
<div class="container my-5">
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-4 p-md-5">
            <div class="text-center mb-5">
                <h3 class="fw-bold mb-2">Help Center</h3>
                <p class="text-muted mb-0">Find quick answers, guidance, and support for using <span class="fw-semibold text-primary">MotoSmart AI</span>.</p>
                <div class="mt-4">
                    <a href="{{ route('footer.getStart') }}" class="btn btn-outline-primary">
                        Learn More <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="h-100 p-4 bg-light rounded-4 border hover-shadow-sm transition">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-circle bg-primary bg-opacity-10 text-primary me-3">
                                <i class="fas fa-motorcycle fa-lg"></i>
                            </div>
                            <h6 class="fw-semibold mb-0">Getting Started</h6>
                        </div>
                        <p class="text-muted small mb-0">
                            Learn how to register your motorcycle, set up reminders, and explore AI-powered diagnostics.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="h-100 p-4 bg-light rounded-4 border hover-shadow-sm transition">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-circle bg-warning bg-opacity-10 text-warning me-3">
                                <i class="fas fa-tools fa-lg"></i>
                            </div>
                            <h6 class="fw-semibold mb-0">Common Issues</h6>
                        </div>
                        <p class="text-muted small mb-0">
                            Diagnose problems fast with our Troubleshooting tools or get referred to a nearby shop.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="h-100 p-4 bg-light rounded-4 border hover-shadow-sm transition">
                        <div class="d-flex align-items-center mb-3">
                            <div class="icon-circle bg-success bg-opacity-10 text-success me-3">
                                <i class="fas fa-user-cog fa-lg"></i>
                            </div>
                            <h6 class="fw-semibold mb-0">Account & Notifications</h6>
                        </div>
                        <p class="text-muted small mb-0">
                            Manage personal data, notification preferences, and service alert settings easily.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
