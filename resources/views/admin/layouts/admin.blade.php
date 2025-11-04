<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('style/custom.css')}}">
    <link rel="stylesheet" href="{{ asset('style/admin/admin.css')}}">
    <link rel="shortcut icon" href="{{ asset('images/primary-logo-2.png')}}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <title>MotoSmart</title>
</head>
@php
    $sidebarHidden = request()->cookie('sidebar-hidden') === 'true';
@endphp

<body class="d-flex flex-column min-vh-100 {{ $sidebarHidden ? 'sidebar-hidden' : '' }}">
    @include('components.adminloader')
    @include('admin.partials.header')
    <div class="d-flex flex-grow-1">
        @include('admin.partials.sidebar')
        <div class="main-content d-flex flex-column flex-grow-1">
            <div class="container-fluid flex-grow-1">
                @yield('content')
            </div>
            @include('admin.partials.footer')
        </div>
    </div>
</body>
<script src="{{ asset('script/button.js')}}"></script>
</html>
