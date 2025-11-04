<div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('admin.settings.store', $shop->shop_id) }}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addressModalLabel">Update Shop Address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Province</label>
                        <select id="provinceSelect" name="province" class="form-select" required>
                            <option value="">Select Province</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">City / Municipality</label>
                        <select id="citySelect" name="city" class="form-select" required>
                            <option value="">Select City</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Barangay</label>
                        <select id="barangaySelect" name="barangay" class="form-select" required>
                            <option value="">Select Barangay</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Address</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="{{ asset('script/address.js')}}"></script>
