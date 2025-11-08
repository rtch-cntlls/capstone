@extends('admin.layouts.admin')
@section('content')
@include('components.adminloader')
<div class="p-2">
    <div class="row">
        <div class="col-md-6 mt-2">
            @include('admin.pages.dashboard.includes.quick-access')
        </div>
        <div class="col-md-6 mt-2">
            @include('admin.pages.dashboard.includes.value')
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="row">
                @foreach ($cards as $index => $card)
                    <div class="col-6 mb-4">
                        <div class="card p-1 h-100">
                            <div class="card-body">
                                <div class="card-title">
                                    <i class="{{ $card['icon'] }}"></i>
                                    <span class="title">{{ $card['title'] }}</span>
                                </div>
                                <p class="card-text form-text">
                                    Total {{ $card['value'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4 p-3">
                @include('admin.pages.dashboard.includes.calendar')
            </div>
        </div>
    </div> 
    <div class="row">
        <div class="col-md-6">
            <div class="card p-3 mb-2">
                @include('admin.pages.dashboard.analytics.weekly-product-sale')
            </div>
            <div class="card p-3 mb-2">
                @include('admin.pages.dashboard.analytics.weekly-service-revenue')
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4 p-3">
                @include('admin.pages.dashboard.includes.recent')
            </div>
        </div>
    </div>    
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4 p-3">
                @include('admin.pages.dashboard.analytics.product-share')
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-4 p-3 ">
                @include('admin.pages.dashboard.analytics.sales-composition')
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-4 p-3 ">
                @include('admin.pages.dashboard.analytics.sales-distribution')
            </div>
        </div>
    </div>    
</div>  
@endsection
