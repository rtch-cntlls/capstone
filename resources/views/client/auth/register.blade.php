<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('style/customer/auth.css') }}">
    <title>Create Account</title>
</head>
<body>
    @include('components.ModalAlertSuccess')
    @include('components.ModalAlertError')
    @include('components.ModalAlertWarning')
    <div class="position-absolute top-0 start-0 p-3 d-flex align-items-center">
        <a class="navbar-brand fw-bold" href="/">
            <h3 class="fw-bold ms-2 logo">
                {{ $shop->shop_name }}
            </h3>
        </a>
    </div>
    <div class="container-fluid h-100">
        <div class="row vh-100">
            <div class="col-md-5 split-left d-none d-md-block"></div>
            <div class="col-md-7 split-right d-flex justify-content-center align-items-center">
                <div class="w-50 p-4 shadow-lg auth-card">
                    @if (!session('register_step') || session('register_step') === 'email')
                    @include('client.auth.partials.email-form')
                    @elseif (session('register_step') === 'otp')
                        @include('client.auth.partials.otp-form')
                        <form method="POST" action="{{ route('auth.resend.otp') }}" class="mt-2 text-end">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-link p-0">Resend code</button>
                        </form>
                    @elseif (session('register_step') === 'password')
                        @include('client.auth.partials.password-form')
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('client.partials.footer')
</body>
<script src="{{ asset('script/customer/login.js')}}"></script>
</html>
