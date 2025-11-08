<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('style/custom.css') }}">
    <title>MotoSmart-AI Admin Login</title>
</head>
<body class="login">
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <form id="loginForm" action="{{ route('admin.login') }}" method="POST" class="col-md-3 p-4 shadow-lg rounded bg-white">
            @csrf
            <div class="text-center mb-4">
                <img src="{{ asset('storage/images/primary-logo.png') }}" alt="MotoSmart Logo" width="80">
                <p class="form-text mt-2">Please enter your credentials to continue</p>
            </div>
            @if (session('error'))
                <x-alert type="danger" :message="session('error')" />
            @endif
            <div class="form-floating mb-3">
                <input type="text" class="form-control @error('email') is-invalid @enderror"
                    id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                <label for="email">Email address</label>
                @error('email')
                    <div class="invalid-feedback error">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                    id="password" name="password" placeholder="Password">
                <label for="password">Password</label>
                @error('password')
                    <div class="invalid-feedback error">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-4">
                <button type="submit" name="log-in" id="loginButton" class="btn btn-primary w-100 py-2 btn-login">
                    <span class="btn-text">Log in</span>
                    <span class="btn-loader spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                </button>
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('admin.forgot-password.form') }}" class="form-text text-decoration-none">Forgot Password?</a>
            </div>
        </form>
    </div>
    <script src="{{ asset('script/button.js')}}"></script>
</body>
</html>
