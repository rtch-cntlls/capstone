@extends('admin.layouts.admin')
@section('content')
<div class="text-center py-5">
    <h1 class="display-4 text-danger">404</h1>
    <p class="lead">Oops! The page you're looking for doesn't exist.</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Go Back Home</a>
</div>
@endsection