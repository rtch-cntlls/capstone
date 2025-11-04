@extends('client.layouts.client')
@section('content')
@include('components.toastAlert')
@include('components.ModalAlertError')
@include('components.ModalAlertSuccess')
@include('client.pages.chat.index')
<div class="container">
    <div class="row">
      <div class="col-12 d-md-none mb-3 position-relative">
        <button class="btn btn-primary" type="button" id="mobileFilterBtn">
            <i class="fas fa-filter me-2"></i> Filter
        </button>
        <div id="mobileFilterSidebar" class="mobile-filter-sidebar">
            <div class="filter-body">
                <div class="text-end">
                    <button class="btn-close" id="closeFilterSidebar"></button>
                </div>
                @include('client.pages.shop.includes.filter')
            </div>
        </div>
    </div>
        <div class="col-md-3 d-none d-md-block">
            @include('client.pages.shop.includes.filter')
        </div>
        <div class="col-12 col-md-9">
            <div id="product-loader" class="text-center my-4" style="display: none;">
                <div class="spinner-border" role="status"></div>
                <p>Loading product...</p>
            </div>
            <div class="row" id="product-list">
                @include('client.pages.shop.product.allProducts')
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('script/customer/filter.js')}}"></script>
@endsection
