<div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <form action="{{ route('account.address.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white rounded-top-3">
                    <h5 class="modal-title fw-semibold" id="addAddressModalLabel">
                        <i class="fas fa-map-marker-alt me-2"></i> Add New Address
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="street" class="form-label fw-semibold">Street</label>
                            <input type="text" class="form-control" id="street" name="street" placeholder="e.g. 123 Main St" required autofocus>
                        </div>
                        <div class="col-md-6">
                            <label for="provinceSelect" class="form-label fw-semibold">Province</label>
                            <select class="form-select" name="province" id="provinceSelect" required>
                                <option value="">Select Province</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="citySelect" class="form-label fw-semibold">City / Municipality</label>
                            <select class="form-select" name="city" id="citySelect" required>
                                <option value="">Select City</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="barangaySelect" class="form-label fw-semibold">Barangay</label>
                            <select class="form-select" name="barangay" id="barangaySelect" required>
                                <option value="">Select Barangay</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="postal_code" class="form-label fw-semibold">Postal Code</label>
                            <input type="text" class="form-control" id="postal_code" name="postal_code" placeholder="e.g. 1001" required>
                        </div>
                    </div>
                </div>

                <div class="modal-footer border-0 p-3">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Cancel
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save me-1"></i> Save Address
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
