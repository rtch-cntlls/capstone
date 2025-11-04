<form method="POST" action="{{ route('auth.customer.register.submit') }}">
    @csrf
    <div class="mb-3">
        <label class="form-label"><i class="fas fa-envelope me-2"></i>Email</label>
        <input type="email" name="email" placeholder="Enter your email"
               value="{{ old('email') }}"
               class="form-control @error('email') is-invalid @enderror">
        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label"><i class="fas fa-user me-2"></i>First Name</label>
            <input type="text" name="firstname" placeholder="Enter your first name"
                   value="{{ old('firstname') }}"
                   class="form-control @error('firstname') is-invalid @enderror">
            @error('firstname')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>

        <div class="col-md-6 mb-3">
            <label class="form-label"><i class="fas fa-user me-2"></i>Last Name</label>
            <input type="text" name="lastname" placeholder="Enter your last name"
                   value="{{ old('lastname') }}"
                   class="form-control @error('lastname') is-invalid @enderror">
            @error('lastname')<div class="invalid-feedback">{{ $message }}</div>@enderror
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label"><i class="fas fa-phone me-2"></i>Phone Number</label>
        <input type="text" name="phone" placeholder="Enter your phone number"
               value="{{ old('phone') }}"
               class="form-control @error('phone') is-invalid @enderror">
        @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label"><i class="fas fa-lock-open me-2"></i>Password</label>
        <input type="password" name="password" placeholder="Enter your password"
               class="form-control @error('password') is-invalid @enderror">
        @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="mb-3">
        <label class="form-label"><i class="fas fa-lock me-2"></i>Confirm Password</label>
        <input type="password" name="password_confirmation" placeholder="Confirm your password"
               class="form-control @error('password_confirmation') is-invalid @enderror">
        @error('password_confirmation')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>

    <div class="form-check mb-3 small">
        <input class="form-check-input" type="checkbox" id="agreeSignup">
        <label class="form-check-label" for="agreeSignup">
            I agree to the <a href="{{ route('footer.termsAndCondition') }}" target="_blank">Terms and Conditions</a> and 
            <a href="{{ route('footer.privacy') }}" target="_blank">Privacy Policy</a>.
        </label>
    </div>

    <button type="submit" class="btn btn-success w-100 text-center" id="authbtn" disabled>
        <span id="authtext">Finish Registration</span>
        <span id="authSpinner" class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
    </button>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const signupBtn = document.getElementById('authbtn');
        const agreeSignup = document.getElementById('agreeSignup');

        agreeSignup.addEventListener('change', function () {
            signupBtn.disabled = !this.checked;
        });
    });
</script>
