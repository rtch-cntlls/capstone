<form method="POST" action="{{ route('auth.customer.register') }}">
    @csrf
    <h4 class="mb-4 fw-bold">Sign Up</h4>
    <div class="mb-3">
        <label class="form-label"><i class="fas fa-envelope me-2"></i>Email or Phone</label>
        <input type="text" name="login" value="{{ old('login') }}" placeholder="Enter your email or phone"
               class="form-control @error('login') is-invalid @enderror" autofocus>
        @error('login')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <button type="submit" class="btn btn-primary w-100 text-center" id="authbtn">
        <span id="authtext">Next</span>
        <span id="authSpinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
    </button>
    <div class="d-flex align-items-center my-2">
        <hr class="flex-grow-1 m-0">
        <span class="px-2 text-muted">or</span>
        <hr class="flex-grow-1 m-0">
    </div>
    <div class="mb-3">
        <a href="{{ route('auth.google.login') }}" class="btn btn-sm btn-outline-dark d-flex justify-content-center align-items-center">
            <img src="{{ asset('images/google.png') }}" class="me-2" alt="Google Logo" style="width: 20px; height: 20px;">
            Continue with Google
        </a>
    </div>
    <div>
        <a href="{{ route('auth.facebook.redirect') }}" class="btn btn-sm btn-outline-primary d-flex justify-content-center align-items-center">
            <img src="{{ asset('images/facebook.png') }}" alt="Facebook Logo" class="me-2" style="width: 20px; height: 20px;">
            Continue with Facebook
        </a>
    </div> 
    <div class="mt-3 text-center form-text">
        <p>Already have an account? <a href="{{ route('auth.customer.login') }}">Log in</a></p>    
    </div>    
</form>
