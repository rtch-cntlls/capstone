@extends('admin.layouts.admin')
@section('content')
    <div class="container text-center mt-5">
        <img src="{{{ asset('storage/images/500.svg')}}}" alt="500 Error" width="200">
        <h1 class="text-danger">Error 500</h1>
        <p class="lead">Something went wrong. Please try again later.</p>
        <a href="{{ route('admin.dashboard.index')}}" class="btn btn-outline-danger">Back to Dashboard</a>
    </div>
@endsection