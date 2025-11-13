<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="{{ asset('style/customer/auth.css') }}">
    <title>Login</title>
</head>
<body>
    @include('components.ModalAlertSuccess')
    @include('components.ModalAlertError')
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
                    <h4 class="mb-4 fw-bold">Login</h4>
                    @if (session('error'))
                        <x-alert type="danger" :message="session('error')" />
                    @endif
                    <form method="POST" action="{{ route('auth.customer.login.submit') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-user me-2"></i>Email or Phone</label>
                            <input type="text" name="login" id="login" class="form-control" placeholder="Enter your email or phone number">
                            @error('login')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>                        
                        <div class="mb-3">
                            <label class="form-label"><i class="fas fa-lock me-2"></i>Password</label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password">
                            @error('password')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <button type="submit" id="authbtn" class="btn btn-sm btn-primary w-100 text-center">
                            <span id="authtext">Login</span>
                            <span id="authSpinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
                        </button>
                        <div class="d-flex align-items-center my-2">
                            <hr class="flex-grow-1 m-0">
                            <span class="px-2 text-muted">or</span>
                            <hr class="flex-grow-1 m-0">
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('auth.google.login') }}" class="btn btn-sm btn-outline-dark d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('images/google.png') }}" class="me-2" alt="Google Logo" style="width: 20px; height: 20px;">
                                    Google
                                </a>
                            </div>
                            <div class="col-md-6">
                                <a href="{{ route('auth.facebook.redirect') }}" class="btn btn-sm btn-outline-primary d-flex justify-content-center align-items-center">
                                    <img src="{{ asset('images/facebook.png') }}" alt="Facebook Logo" class="me-2" style="width: 20px; height: 20px;">
                                    Facebook
                                </a>
                            </div> 
                        </div>
                        <div class="mt-3 text-center form-text">
                            <p>Don't have an account? <a href="{{route('auth.customer.register')}}">Register</a></p>    
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @include('client.partials.footer')
</body>
<script src="{{ asset('script/customer/login.js')}}"></script>
</html>
