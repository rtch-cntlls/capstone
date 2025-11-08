<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MotoSmart Admin - Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('style/custom.css') }}">
</head>
<body class="login">
<div class="vh-100 d-flex justify-content-center align-items-center">
    <form action="{{ route('admin.reset-password.update') }}" method="POST" class="col-md-4 p-4 shadow-lg rounded bg-white">
        @csrf
        <div class="text-center mb-4">
            <img src="{{ asset('storage/images/primary-logo.png') }}" alt="MotoSmart Logo" width="80">
            <h4 class="mt-2">Reset Password</h4>
            <p class="form-text">Enter your new password to continue</p>
        </div>
        @if(session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <input type="hidden" name="token" value="{{ $token }}">
        <div class="mb-3">
            <label for="password" class="form-label">New Password</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" 
                   id="password" name="password" placeholder="Enter new password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirm Password</label>
            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                   id="password_confirmation" name="password_confirmation" placeholder="Confirm new password" required>
            @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="d-grid mt-3">
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </div>

        <div class="text-center mt-3">
            <a href="{{ route('admin.login.form') }}" class="form-text">Back to Login</a>
        </div>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
