<form method="POST" action="{{ route('auth.customer.register') }}">
    @csrf
    <div class="mb-4">
        <label class="form-label"><i class="fas fa-key me-2"></i>OTP</label>
        <input type="text" name="otp" placeholder="Please enter your OTP number" autofocus
               class="form-control @error('otp') is-invalid @enderror">
        @error('otp')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="d-flex gap-2">
        <button type="submit" class="btn btn-sm btn-primary flex-fill text-center" id="authbtn">
            <span id="authSpinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            <span id="authtext">Verify OTP</span>
        </button>

        <a href="{{ route('auth.customer.backToEmail') }}" class="btn btn-sm btn-secondary flex-fill">
            Back
        </a>
    </div>
</form>
