<h6 class="fw-bold">Store Settings</h6>
<form action="{{ route('admin.settings.store', $shop->shop_id) }}" method="POST">
    @csrf
    <div class="mb-3 d-flex align-items-center">
        <label for="store-name" class="form-label me-3" style="width: 140px;">Shop Name</label>
        <input type="text" name="shop_name" id="store-name"
               class="form-control border-0 border-bottom fw-bold no-outline"
               value="{{ old('shop_name', $shop->shop_name) }}"
               onchange="this.form.submit()">
    </div>
</form>
<form action="{{ route('admin.settings.store', $shop->shop_id) }}" method="POST">
    @csrf
    <div class="mb-3 d-flex align-items-center justify-content-between">
        <label for="store-address" class="form-label" style="width: 140px;">Shop Address</label>
        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#addressModal">
            Add Shop Address
        </button>
        @include('admin.pages.setting.address')
    </div>
</form>
<div>
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label me-3" style="width: 140px;">Barangay</label>
        <input type="text" name="barangay" id="barangay"
               class="form-control border-0 border-bottom fw-bold no-outline"
               value="{{ old('barangay', $shop->barangay) }}" readonly>
    </div>
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label me-3" style="width: 140px;">City</label>
        <input type="text" name="city" id="city"
               class="form-control border-0 border-bottom fw-bold no-outline"
               value="{{ old('city', $shop->city) }}" readonly>
    </div>
    <div class="mb-3 d-flex align-items-center">
        <label class="form-label me-3" style="width: 140px;">Province</label>
        <input type="text" name="province" id="province"
               class="form-control border-0 border-bottom fw-bold no-outline"
               value="{{ old('province', $shop->province) }}" readonly>
    </div>
</div>
