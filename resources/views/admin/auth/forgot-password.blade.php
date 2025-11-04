<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style/custom.css')}}">
    <title>Forgot Password</title>
</head>
<body class="login">
    <div class="vh-100 d-flex justify-content-center align-items-center">
        <form id="forgotForm" action="{{ route('admin.forgot-password.send') }}" method="POST" class="col-md-3 p-4 shadow-lg rounded">
            @csrf
            <div class="text-center mb-4">
                <img src="{{asset('images/primary-logo.png')}}" alt="MotoSmart Logo" width="80">
                <p class="form-text mt-2">Enter your email to reset your password</p>
            </div>
            @if (session('status'))
                <div class="alert alert-success small py-2 mb-3">{{ session('status') }}</div>
            @endif
            <div class="form-floating mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                    id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                <label for="email">Email address</label>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mt-4">
                <button type="submit" id="forgotButton" class="btn btn-primary w-100 py-2 btn-login">
                    <span class="btn-text">Send Reset Link</span>
                    <span class="btn-loader spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                </button>
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('admin.login.form') }}" class="form-text text-decoration-none">Back to Login</a>
            </div>
        </form>
    </div>
    <script src="{{ asset('script/button.js')}}"></script>
</body>
</html>
