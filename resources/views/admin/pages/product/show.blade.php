@extends('admin.layouts.admin')
@section('content')
@include('admin.pages.product.add-discount')
@include('admin.pages.product.edit-price')
@include('components.ModalAlertSuccess')
@include('components.ModalAlertError')
@include('components.AdminLoader')
<div class="mt-2 mb-2">
    <a href="{{ url()->previous() }}" class="text-decoration-none small text-muted">
        <i class="fas fa-arrow-left me-1"></i> Back
    </a>
</div>
    <div class="row p-2 align-items-center">
        <div class="col-md-6">
            <h5 class="fw-bold m-0">Product details</h5>
        </div>
        <div class="col-md-6 text-md-end text-start mt-2 mt-md-0">
            <button class="btn btn-primary" style="font-size: 11px;" data-bs-toggle="modal" data-bs-target="#addDiscountModal">
                <i class="fa fa-plus me-1"></i> <span class="fw-bold">Apply Discount</span>
            </button>    
            <button class="btn btn-success" style="font-size: 11px;" data-bs-toggle="modal" data-bs-target="#editPricingModal">
                <i class="fa fa-pen me-1"></i> <span class="fw-bold">Edit Pricing</span>
            </button>                  
        </div>
    </div>  
    <div class="row p-3">
        <div class="col-md-3">
            <div class="card p-3 text-center">
                <img src="{{ $product->image ? asset($product->image) : asset('images/placeholder.png') }}" class="card-img-top image">
                <div class="card-body">
                    <h6 class="card-title">{{ $product->product_name }}</h6>
                </div>
            </div>
        </div>
        <div class="col-md-9"> 
            <div class="p-3 position-relative">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled position-relative timeline m-2">
                            @include('admin.pages.product.includes.product-info')
                            @include('admin.pages.product.includes.discount')
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled position-relative timeline m-2">
                            @include('admin.pages.product.includes.pricing')
                            @include('admin.pages.product.includes.profit')
                            @include('admin.pages.product.includes.sales')                  
                        </ul>
                    </div>
                </div>
                <div class="text-end">
                    <a href="{{ route('admin.inventory.show', ['id' => $product->inventory->inventory_id]) }}" 
                    class="btn btn-outline-primary fw-bold"><i class="fas fa-eye me-2"></i>View inventory details</a>
                </div>
            </div>
        </div>
    </div>
@endsection