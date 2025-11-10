@include('client.pages.account.create-address')
@include('client.pages.account.create-personal-info')
@include('components.ModalAlertSuccess')
@include('components.ModalAlertError')
<div class="card shadow-sm border-0 rounded-3 mb-4">
    <div class="card-body">
        <div class="mb-4">
            <div class="d-flex align-items-center justify-content-between">
                <h5 class="fw-semibold text-primary mb-3">
                    <i class="fas fa-id-card me-1"></i> Personal Information
                </h5>
                <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                    <i class="fas fa-edit me-1"></i> Edit Info
                </button>
            </div>
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label text-muted small">Full Name</label>
                    <div class="p-2 bg-light rounded border">
                        {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}
                    </div>                    
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small">Email</label>
                    <div class="p-2 bg-light rounded border">{{ Auth::user()->email }}</div>
                </div>
                <div class="col-md-6">
                    <label class="form-label text-muted small">Phone Number</label>
                    <div class="p-2 bg-light rounded border">{{ Auth::user()->customer->phone ?? 'N/A' }}</div>
                </div>
            </div>
        </div>
        <hr>
        @if ($address)
            <div class="mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <h5 class="fw-semibold text-primary mb-3">
                        <i class="fas fa-map-marker-alt me-1"></i> Address
                    </h5>
                    <button class="btn btn-outline-primary btn-sm"  data-bs-toggle="modal" data-bs-target="#addAddressModal">
                        <i class="fas fa-edit me-1"></i> New Address
                    </button>
                </div>
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label text-muted small">Street</label>
                        <div class="p-2 bg-light rounded border">{{ $address->street ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small">Province</label>
                        <div class="p-2 bg-light rounded border">{{ $address->province ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small">City / Municipality</label>
                        <div class="p-2 bg-light rounded border">{{ $address->city ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small">Barangay</label>
                        <div class="p-2 bg-light rounded border">{{ $address->barangay ?? 'N/A' }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label text-muted small">Postal Code</label>
                        <div class="p-2 bg-light rounded border">{{ $address->postal_code ?? 'N/A' }}</div>
                    </div>
                </div>
            </div>
        @else
        <div class="text-center py-5">
            <div class="mb-3">
                <img src="{{ asset('storage/images/address.jpg') }}" alt="No Address" width="100">
            </div>
            <h5 class="fw-bold text-muted mb-2">No Address Found</h5>
            <p class="text-muted small mb-3">
                You haven’t added any addresses yet.
            </p>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAddressModal">
                <i class="fas fa-plus me-1"></i> Add Address
            </button>
        </div>
        
        @endif
    </div>
</div>
<script src="{{ asset('script/address.js')}}"></script>
