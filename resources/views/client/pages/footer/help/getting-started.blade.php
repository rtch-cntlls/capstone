@extends('client.layouts.client')
@section('content')
<div class="container">
    <div class="card border-0 shadow-sm">
        <div class="card-body p-4 p-md-5">
            <div class="mb-4">
                <a href="{{ route('footer.helpCenter') }}" class="text-decoration-none small text-muted d-flex align-items-center">
                    <i class="fas fa-arrow-left me-2"></i> Back 
                </a>
            </div>
            <div class="text-center mb-5">
                <h3 class="fw-bold mb-2">Getting Started with MotoSmart AI</h3>
                <p class="text-muted mb-0">Learn how to register your motorcycle, monitor issues, and follow AI-powered maintenance schedules for optimal performance.</p>
            </div>
            <div class="row g-4">
                <div class="col-12">
                    <div class="p-4 bg-light rounded-4 border hover-shadow transition">
                        <h5 class="fw-semibold mb-3 d-flex align-items-center">
                            <i class="fas fa-motorcycle me-2"></i> Register Your Motorcycle
                        </h5>
                        <p class="text-muted mb-3">Before using MotoSmart AI, register your motorcycle by filling out the required information:</p>
                        <ol class="text-muted small mb-3">
                            <li>Select your <strong>Brand</strong> from the dropdown.</li>
                            <li>Choose your <strong>Model</strong> (updates automatically based on brand).</li>
                            <li>Enter the <strong>Current Mileage</strong> in kilometers.</li>
                            <li>Optionally, enter the <strong>Last Service Date</strong>.</li>
                            <li>Select the <strong>Last Service Type</strong> (engine oil change, brake check, etc.).</li>
                            <li>Click <strong>Save Motorcycle</strong> to complete registration.</li>
                        </ol>
                        <div class="small mb-0 d-flex align-items-center">
                            <i class="fas fa-lightbulb me-2"></i> Tip: You can register multiple motorcycles under one account.
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-4 bg-light rounded-4 border hover-shadow transition">
                        <h5 class="fw-semibold mb-3 d-flex align-items-center">
                            <i class="fas fa-brain me-2"></i> AI Troubleshooting & Common Issues
                        </h5>
                        <p class="text-muted mb-3">MotoSmart AI analyzes your motorcycle’s data to identify potential issues and provide step-by-step troubleshooting guidance:</p>
                        <ul class="text-muted small mb-3">
                            <li><strong>Basic Troubleshooting:</strong> Easy fixes you can perform at home. View step-by-step instructions and expand for full details.</li>
                            <li><strong>Mechanic Required:</strong> For issues that cannot be resolved at home, the system will alert you and suggest visiting a professional repair shop.</li>
                        </ul>
                        <div class="small mb-0 d-flex align-items-center">
                            <i class="fas fa-wrench me-2"></i> Note: AI-generated insights are powered by Gemini Flash AI.
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="p-4 bg-light rounded-4 border hover-shadow transition">
                        <h5 class="fw-semibold mb-3 d-flex align-items-center">
                            <i class="fas fa-calendar-check me-2"></i> Recommended Maintenance Schedule
                        </h5>
                        <p class="text-muted mb-3">MotoSmart AI generates a personalized maintenance plan based on your motorcycle’s usage, service history, and AI diagnostics:</p>
                        <ul class="text-muted small mb-3">
                            <li><strong>Overview:</strong> A summary of your motorcycle’s condition and important notes.</li>
                            <li><strong>Scheduled Tasks:</strong> Recommended maintenance tasks with suggested intervals (km or months).</li>
                            <li><strong>AI Monitoring:</strong> The system continually updates tasks as it collects more data.</li>
                        </ul>
                        <div class="small mb-0 align-items-center">
                            <p class="mb-1"><i class="fas fa-clock me-2"></i> Tip: Following these recommended schedules helps prevent costly repairs and keeps your motorcycle in top condition.</p>
                        </div>
                    </div>
                </div>

            </div>
            <div class="mt-5 pt-3 border-top text-center">
                <p class="text-muted small mb-0">
                    <i class="fas fa-info-circle me-1"></i> AI-generated insights are provided by <strong>Gemini Flash AI</strong>. Results are recommendations and do not replace professional inspection or repair.
                </p>
            </div>

        </div>
    </div>
</div>
@endsection
