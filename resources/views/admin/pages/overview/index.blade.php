@extends('admin.layouts.admin')
@section('content')
<div class="py-2">
    @include('admin.pages.overview.cards.index')
    @include('admin.pages.overview.sale-trends') 
    <div class="row px-2">
        @include('admin.pages.overview.recent-sold') 
        @include('admin.pages.overview.top-products') 
        @include('admin.pages.overview.revenue') 
    </div>
</div>
@endsection
