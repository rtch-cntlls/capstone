@extends('admin.layouts.admin')
@section('content')
@include('components.ModalAlertSuccess')
@include('components.ModalAlertError')
<div class="row mt-4 m-3 settings">
    <div class="col-md-6">
        @include('admin.pages.setting.includes.store-details')
    </div>
    <div class="col-md-6">
        @include('admin.pages.setting.includes.order-details')
    </div>    
</div>
<div class="row mt-4 m-3 settings">
    <div class="col-md-12">
        @include('admin.pages.setting.includes.admin-account')
    </div>
</div>
@endsection