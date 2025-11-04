@extends('client.layouts.client')
@section('content')
    <div class="container text-center mt-5">
        <img src="{{{ asset('images/500.svg')}}}" alt="500 Error" width="200">
        <h1 class="text-danger">Error 500</h1>
        <p class="lead">Something went wrong. Please try again later.</p>
        <a href="{{ url()->previous() }}" class="btn btn-outline-danger">Back</a>
    </div>
@endsection