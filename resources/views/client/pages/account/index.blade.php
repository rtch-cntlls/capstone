@extends('client.layouts.clientNoFooter')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('client.partials.accountnav')
        </div>
        <div class="col-md-9">
            @include('client.pages.account.includes.profile')
        </div>
    </div>
</div>
@endsection