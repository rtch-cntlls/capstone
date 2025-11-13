@extends('admin.layouts.admin')
@section('content')
@include('components.ModalAlertSuccess')
@include('components.ModalAlertError')
@include('components.ModalAlertWarning')
@include('admin.pages.inventory.add-stock')
<div class="p-2">
    <div class="mt-2 mb-2">
        <a href="{{ url()->previous() }}" class="text-decoration-none small text-muted">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center mb-4 gap-2">
        <h5 class="fw-bold m-0">Inventory Details</h5>
        <div class="d-flex flex-wrap gap-2">
            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addStockModal">
                <i class="fas fa-plus me-1"></i> Add Stock
            </button>
        </div>
    </div>
    <div class="row g-3">
         <div class="col-md-3">
            <div class="card p-3 text-center">
                <img src="{{ $inventory->product->image 
                    ? asset($inventory->product->image) 
                    : asset('images/placeholder.png') }}" 
                    class="card-img-top image">
                <div class="card-body">
                    <h6 class="card-title">{{ $inventory->product->product_name }}</h6>
                </div>
            </div>            
        </div>
        <div class="col-12 col-md-9">
            <div class="row g-3">
                <div class="col-12 col-lg-8">
                    <div class="bg-white rounded-3 shadow-sm p-3 h-100">
                        <h6 class="fw-bold mb-3"><i class="me-2 {{ $card[0]['icon'] }}"></i>{{ $card[0]['title'] }}</h6>
                        <div class="row g-3">
                            @foreach ($card[0]['items'] as $item)
                                <div class="col-6 col-md-4">
                                    <div class="bg-light rounded p-3 h-100 d-flex flex-column justify-content-between">
                                        <h6 class="fw-semibold mb-2 {{ $item['color'] }}">{{ $item['label'] }}</h6>
                                        <p class="text-muted mb-0">{{ $item['value'] }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-4">
                    <div class="bg-white rounded-3 shadow-sm p-3 h-100 d-flex flex-column gap-3">
                        <div>
                            <h6 class="fw-bold mb-2"><i class="me-2 {{ $card[2]['icon'] }}"></i>{{ $card[2]['title'] }}</h6>
                            <div class="bg-light rounded p-2">
                                <div class="d-flex justify-content-between">
                                    <span>{{ $card[2]['items'][0]['label'] }}</span>
                                    <span class="text-success">₱{{ $card[2]['items'][0]['value'] }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="bg-white rounded-3 shadow-sm p-3">
                        <h6 class="fw-bold mb-2"><i class="me-2 {{ $card[3]['icon'] }}"></i>{{ $card[3]['title'] }}</h6>
                        <a class="btn btn-light border w-100 text-start mb-3" 
                           data-bs-toggle="collapse" href="#historyCollapse" role="button" 
                           aria-expanded="false" aria-controls="historyCollapse">
                            Restock History
                        </a>
                        <div class="collapse" id="historyCollapse">
                            <div class="p-2">
                                @foreach ($inventory->histories as $history)
                                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center bg-light rounded p-2 mb-2">
                                        <div class="me-md-3">
                                            <span class="fw-bold">Date Added:</span> 
                                            <span class="text-success">{{ $history->action_date?->format('M d, Y (h:i A)') ?? 'N/A' }}</span>
                                        </div>
                                        <div>
                                            <span class="fw-bold">Quantity Added:</span> 
                                            <span class="text-primary">{{ $history->quantity }} {{ Str::plural('item', $history->quantity) }}</span>
                                        </div>
                                    </div>
                                @endforeach                            
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-end mt-3">
                <a href="{{ route('admin.product.show', ['id' => $inventory->product->product_id]) }}" 
                   class="btn btn-outline-primary fw-bold">
                    <i class="fas fa-eye me-2"></i> View Product Details
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
