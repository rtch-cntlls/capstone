<div class="my-3">
    <h4 class="fw-bold"><i class="fas fa-user me-2"></i>Personal Info</h4>
    <div class="row g-2">
        @php
            $user = Auth::user();
            $customer = $user->customer ?? null;
        @endphp

        <!-- First Name -->
        <div class="col-6 col-md-6 mb-2">
            <label for="firstname" class="small fw-semibold">First Name</label>
            <input type="text" id="firstname" name="firstname" class="form-control"
                   value="{{ old('firstname', $user->firstname) }}" required>
            @error('firstname')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Last Name -->
        <div class="col-6 col-md-6 mb-2">
            <label for="lastname" class="small fw-semibold">Last Name</label>
            <input type="text" id="lastname" name="lastname" class="form-control"
                   value="{{ old('lastname', $user->lastname) }}" required>
            @error('lastname')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Email -->
        <div class="col-6 col-md-6 mb-2">
            <label for="email" class="small fw-semibold">Email Address</label>
            <input type="email" id="email" name="email" class="form-control"
                   value="{{ old('email', $user->email) }}" required>
            @error('email')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Phone -->
        <div class="col-6 col-md-6 mb-2">
            <label for="phone" class="small fw-semibold">Phone number</label>
            <input type="text" id="phone" name="phone" class="form-control"
                   value="{{ old('phone', $customer->phone ?? '') }}" required>
            @error('phone')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>
