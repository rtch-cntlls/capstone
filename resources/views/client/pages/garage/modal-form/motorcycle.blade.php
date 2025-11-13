<div class="modal fade" id="motorcycleModal" tabindex="-1" aria-labelledby="motorcycleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 shadow">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title fw-bold" id="motorcycleModalLabel">Register Your Motorcycle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('garage.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="brand" class="form-label fw-semibold">Brand</label>
                        <select name="brand" id="brand" class="form-select rounded-3" required>
                            <option value="" disabled selected>-- Select Brand --</option>
                            @foreach($brands as $brand => $models)
                                <option value="{{ $brand }}" {{ old('brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="model" class="form-label fw-semibold">Model</label>
                        <select name="model" id="model" class="form-select rounded-3" required>
                            <option value="" disabled selected>-- Select Model --</option>
                            @if(old('brand') && isset($brands[old('brand')]))
                                @foreach($brands[old('brand')] as $model)
                                    <option value="{{ $model }}" {{ old('model') == $model ? 'selected' : '' }}>{{ $model }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="mileage_at_service" class="form-label fw-semibold">Last Mileage at Service (km)</label>
                        <input type="number" name="mileage_at_service" id="mileage_at_service"
                                class="form-control rounded-3" placeholder="Enter mileage"
                                min="0" max="100000" required>
                    </div>
                    <div class="mb-3">
                        <label for="last_done_at" class="form-label fw-semibold">Last Service Date</label>
                        <input type="date" name="last_done_at" id="last_done_at" 
                               class="form-control rounded-3" 
                               required>
                    </div>
                    <div class="mb-3">
                        <label for="service_type" class="form-label fw-semibold">Last Service Type</label>
                        <select name="service_type" id="service_type" class="form-select rounded-3" required>
                            <option value="" disabled selected>-- Select Service Type --</option>
                            <option value="Engine Oil Change">Engine Oil Change</option>
                            <option value="Gear Oil Change">Gear Oil Change</option>
                            <option value="Spark Plug Replacement">Spark Plug Replacement</option>
                            <option value="Air Filter Replacement">Air Filter Replacement</option>
                            <option value="Brake Check">Brake Check</option>
                            <option value="Chain Adjustment and Lubrication">Chain Adjustment and Lubrication</option>
                            <option value="Tire Pressure Check">Tire Pressure Check</option>
                            <option value="Battery Inspection">Battery Inspection</option>
                            <option value="Headlight and Taillight Check">Headlight and Taillight Check</option>
                            <option value="Coolant System Flush">Coolant System Flush</option>
                            <option value="Brake Fluid Replacement">Brake Fluid Replacement</option>
                            <option value="Drive Belt or Sprocket Inspection">Drive Belt or Sprocket Inspection</option>
                            <option value="Suspension Check">Suspension Check</option>
                            <option value="Throttle and Clutch Cable Lubrication">Throttle and Clutch Cable Lubrication</option>
                            <option value="Fuel Filter Replacement">Fuel Filter Replacement</option>
                            <option value="Fork Oil Replacement">Fork Oil Replacement</option>
                            <option value="Fork Rebuilding">Fork Rebuilding</option>
                            <option value="Rear Sprocket Inspection">Rear Sprocket Inspection</option>
                            <option value="Electrical System Inspection">Electrical System Inspection</option>
                            <option value="Battery Terminal Cleaning">Battery Terminal Cleaning</option>
                        </select>
                    </div>
                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <button type="button" class="btn btn-outline-secondary rounded-3" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary rounded-3" id="saveMotorcycleBtn">
                            <span id="btnText">Save Motorcycle</span>
                            <span id="btnLoader" class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></span>
                        </button>                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const brands = @json($brands);
    const brandSelect = document.getElementById('brand');
    const modelSelect = document.getElementById('model');

    brandSelect.addEventListener('change', function() {
        const selectedBrand = this.value;
        modelSelect.innerHTML = '<option value="" disabled selected>-- Select Model --</option>';

        if (selectedBrand && brands[selectedBrand]) {
            brands[selectedBrand].forEach(model => {
                const option = document.createElement('option');
                option.value = model;
                option.textContent = model;
                modelSelect.appendChild(option);
            });
        }
    });

    const form = document.querySelector('#motorcycleModal form');
    const saveBtn = document.getElementById('saveMotorcycleBtn');
    const btnText = document.getElementById('btnText');
    const btnLoader = document.getElementById('btnLoader');

    form.addEventListener('submit', function() {
        btnText.textContent = 'Saving...';
        btnLoader.classList.remove('d-none');

        saveBtn.disabled = true;
    });

    const lastDoneInput = document.getElementById('last_done_at');
    const today = new Date().toISOString().split('T')[0];
    lastDoneInput.setAttribute('max', today);
</script>
