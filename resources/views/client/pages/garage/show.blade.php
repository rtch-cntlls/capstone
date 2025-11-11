@extends('client.layouts.clientNoFooter')
@section('content')
@php
    $brand = strtolower($motorcycle->brand);
    $model = strtolower(str_replace(' ', '-', $motorcycle->model));
    $imagePath = "motorcycle/{$brand}/{$model}.webp";
    $publicPath = public_path($imagePath);
    $basicCount = count($issues['basic'] ?? []);
    $mechanicCount = count($issues['mechanic_required'] ?? []);
@endphp

<div class="container">
    @include('client.pages.garage.includes.nav')

    <div class="row mb-4 position-relative">
        @if(!$basicCount && !$mechanicCount)
            <div class="section-overlay d-flex flex-column justify-content-center align-items-center">
                <img src="{{ asset('images/generating.gif') }}" alt="Generating..." width="250" class="mb-3 opacity-75">
                <h6 class="fw-bold text-muted mb-2">Analyzing Motorcycle Data...</h6>
                <p class="text-secondary small mb-0">Please wait while Gemini AI generates troubleshooting insights.</p>
            </div>
        @endif

        <div class="col-lg-4 col-md-5 mb-3">
            <div class="card border-0 shadow-sm overflow-hidden h-100">
                <img src="{{ file_exists($publicPath) ? asset($imagePath) : asset('images/motorcycle.jpg') }}"
                    alt="{{ $motorcycle->model }}" 
                    class="img-fluid w-100">
                <div class="card-body text-center">
                    <h4 class="fw-bold mb-1 text-dark">{{ $motorcycle->model }}</h4>
                    <p class="text-muted mb-0 text-uppercase small">{{ $motorcycle->brand }}</p>
                </div>
            </div>
        </div>

        <div class="col-lg-8 col-md-7">
            <div class="px-2 px-md-3">
                @if($basicCount)
                    <h5 class="fw-bold mb-3 d-flex align-items-center">
                        <span class="icon-circle bg-light-primary me-2">
                            <i class="fas fa-tools text-primary"></i>
                        </span>
                        Basic Troubleshooting
                    </h5>
                    <div id="basicIssuesCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($issues['basic'] as $index => $item)
                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                    <div class="card shadow-sm border-0 p-3 h-100">
                                        <div class="row g-3 align-items-stretch">
                                            <div class="col-md-4 col-12 d-flex">
                                                <img src="{{ asset('images/troubleshoot.jpg') }}" 
                                                     alt="Issue Image"  
                                                     class="img-fluid rounded-3 w-100 object-fit-cover"
                                                     style="min-height: 180px;">
                                            </div>
                                            <div class="col-md-8 col-12 d-flex flex-column justify-content-between">
                                                <div>
                                                    <h6 class="fw-bold text-primary mb-2">{{ $item['title'] }}</h6>
                                                    <ol class="text-muted small mb-2 ps-3">
                                                        @php $halfSteps = ceil(count($item['steps']) / 2); @endphp
                                                        @foreach(array_slice($item['steps'], 0, $halfSteps) as $step)
                                                            <li>{{ $step }}</li>
                                                        @endforeach
                                                    </ol>
                                                </div>
                                                <div class="mt-2">
                                                    <button class="btn btn-outline-primary btn-sm rounded-3 fw-semibold" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#basicIssueModal{{ $index }}">
                                                        <i class="fas fa-eye me-1"></i> View Full Details
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal fade" id="basicIssueModal{{ $index }}" tabindex="-1" aria-labelledby="basicIssueModalLabel{{ $index }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content shadow-lg border-0">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title fw-bold" id="basicIssueModalLabel{{ $index }}">
                                                    {{ $item['title'] }}
                                                </h5>
                                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h6 class="fw-bold mb-3 text-dark">Step-by-Step Troubleshooting</h6>
                                                <ol class="ps-3">
                                                    @foreach($item['steps'] as $step)
                                                        <li>{{ $step }}</li>
                                                    @endforeach
                                                </ol>
                                                <div class="mt-2">
                                                    <strong class="small text-muted">Source:</strong> 
                                                    <span class="small text-secondary">{{ $item['source'] ?? 'AI-generated' }}</span>
                                                </div>
                                                <div class="alert alert-warning small mt-3">
                                                    <i class="fas fa-triangle-exclamation me-1"></i>
                                                    If not resolved, please visit a nearby repair shop.
                                                </div>
                                            </div>                                            
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary rounded-3 px-4" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if($basicCount > 1)
                            <button class="carousel-control-prev" type="button" data-bs-target="#basicIssuesCarousel" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#basicIssuesCarousel" data-bs-slide="next">
                                <span class="carousel-control-next-icon bg-dark rounded-circle p-2" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>

    @if($mechanicCount)
        <h5 class="fw-bold mb-3 d-flex align-items-center">
            <span class="icon-circle bg-light-danger me-2">
                <i class="fas fa-triangle-exclamation text-danger"></i>
            </span>
            Mechanic Required
        </h5>
        <div class="row g-3 mb-4">
            @foreach($issues['mechanic_required'] as $m)
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="card h-100 border-0 shadow-sm p-3 bg-light">
                        <p class="text-dark mb-0">{{ $m['issue'] ?? 'Unknown Issue' }}</p>
                        @if(!empty($m['source']))
                            <small class="text-muted d-block mt-1">Source: {{ $m['source'] }}</small>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

@if(!$basicCount && !$mechanicCount)
<script>
    setTimeout(() => location.reload(), 10000);
</script>
@endif
@endsection
