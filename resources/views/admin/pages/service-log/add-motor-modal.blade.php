<!-- Add Motor Modal -->
<div class="modal fade" id="addMotorModal" tabindex="-1" aria-labelledby="addMotorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3 shadow-sm border-0">
            <form action="{{ route('admin.service-logs.add-motor', 0) }}" method="POST" id="addMotorForm" class="p-3">
                @csrf
                <input type="hidden" name="service_id" id="service_id">
                
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="addMotorModalLabel">Add Motorcycle Service Record</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-2">
                    <div class="mb-3">
                        <label for="motorcycle_brand" class="form-label fw-medium">Motorcycle Brand</label>
                        <div class="input-group mb-2">
                            <select id="motorcycle_brand" name="motorcycle_brand" class="form-select form-select-lg @error('motorcycle_brand') is-invalid @enderror" required>
                                <option value="" selected>-- Select Brand --</option>
                                @foreach($brands ?? [] as $brand => $models)
                                    <option value="{{ $brand }}" {{ old('motorcycle_brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                                @endforeach
                                <option value="other">Other (Specify)</option>
                            </select>
                        </div>
                        <div id="newBrandContainer" class="mb-2" style="display: none;">
                            <input type="text" class="form-control form-control-lg" id="new_brand" name="new_brand" placeholder="Enter new brand name">
                        </div>
                        @error('motorcycle_brand')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="motorcycle_model" class="form-label fw-medium">Motorcycle Model</label>
                        <select id="motorcycle_model" name="motorcycle_model" class="form-select form-select-lg @error('motorcycle_model') is-invalid @enderror" required>
                            <option value="" selected>-- Select Model --</option>
                            @if(old('motorcycle_brand') && isset($brands[old('motorcycle_brand')]))
                                @foreach($brands[old('motorcycle_brand')] as $model)
                                    <option value="{{ $model }}" {{ old('motorcycle_model') == $model ? 'selected' : '' }}>{{ $model }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('motorcycle_model')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="last_mileage" class="form-label fw-medium">Last Mileage at Service (km)</label>
                        <input type="number" id="last_mileage" name="last_mileage" class="form-control form-control-lg @error('last_mileage') is-invalid @enderror" placeholder="Enter last service mileage" min="0" value="{{ old('last_mileage') }}">
                        @error('last_mileage')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="last_service_date" class="form-label fw-medium">Last Service Date</label>
                        <input type="date" id="last_service_date" name="last_service_date" class="form-control form-control-lg @error('last_service_date') is-invalid @enderror" required max="{{ date('Y-m-d') }}" value="{{ old('last_service_date', date('Y-m-d')) }}">
                        @error('last_service_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="last_service_type" class="form-label fw-medium">Last Service Type</label>
                        <select id="last_service_type" name="last_service_type" class="form-select form-select-lg @error('last_service_type') is-invalid @enderror" required>
                            <option value="" {{ old('last_service_type') === null ? 'selected' : '' }}>-- Select Service Type --</option>
                            <option value="Change oil" {{ old('last_service_type') == 'Change oil' ? 'selected' : '' }}>Change oil</option>
                            <option value="Oil filter replacement">Oil filter replacement</option>
                            <option value="Air filter cleaning">Air filter cleaning</option>
                            <option value="Air filter replacement">Air filter replacement</option>
                            <option value="Fuel filter replacement">Fuel filter replacement</option>
                            <option value="Spark plug replacement">Spark plug replacement</option>
                            <option value="Carburetor cleaning">Carburetor cleaning</option>
                            <option value="Carburetor rebuild">Carburetor rebuild</option>
                            <option value="Fuel injector cleaning">Fuel injector cleaning</option>
                            <option value="Throttle body cleaning">Throttle body cleaning</option>
                            <option value="Valve clearance adjustment">Valve clearance adjustment</option>
                            <option value="Engine tune-up">Engine tune-up</option>
                            <option value="Engine flush">Engine flush</option>
                            <option value="Top overhaul">Top overhaul</option>
                            <option value="Full engine overhaul">Full engine overhaul</option>
                            <option value="Cylinder head gasket replacement">Cylinder head gasket replacement</option>
                            <option value="Piston ring replacement">Piston ring replacement</option>
                            <option value="Piston replacement">Piston replacement</option>
                            <option value="Timing chain replacement">Timing chain replacement</option>
                            <option value="Engine mount replacement">Engine mount replacement</option>
                            <option value="Intake manifold repair">Intake manifold repair</option>
                            <option value="Exhaust gasket replacement">Exhaust gasket replacement</option>
                            <option value="Radiator coolant replacement">Radiator coolant replacement</option>
                            <option value="Radiator cleaning">Radiator cleaning</option>
                            <option value="Radiator fan repair">Radiator fan repair</option>
                            <option value="Water pump replacement">Water pump replacement</option>
                            <option value="Thermostat replacement">Thermostat replacement</option>
                            <option value="Clutch lining replacement">Clutch lining replacement</option>
                            <option value="Clutch spring replacement">Clutch spring replacement</option>
                            <option value="Clutch assembly replacement">Clutch assembly replacement</option>
                            <option value="Clutch cable replacement">Clutch cable replacement</option>
                            <option value="Gear oil replacement (scooters)">Gear oil replacement (scooters)</option>
                            <option value="Transmission oil replacement">Transmission oil replacement</option>
                            <option value="CVT belt replacement">CVT belt replacement</option>
                            <option value="CVT roller/slider replacement">CVT roller/slider replacement</option>
                            <option value="CVT clutch shoe replacement">CVT clutch shoe replacement</option>
                            <option value="CVT cleaning">CVT cleaning</option>
                            <option value="Chain cleaning">Chain cleaning</option>
                            <option value="Chain lubrication">Chain lubrication</option>
                            <option value="Chain replacement">Chain replacement</option>
                            <option value="Sprocket (front) replacement">Sprocket (front) replacement</option>
                            <option value="Sprocket (rear) replacement">Sprocket (rear) replacement</option>
                            <option value="Chain and sprocket set replacement">Chain and sprocket set replacement</option>
                            <option value="Brake pad replacement">Brake pad replacement</option>
                            <option value="Brake shoe replacement">Brake shoe replacement</option>
                            <option value="Brake fluid bleeding">Brake fluid bleeding</option>
                            <option value="Brake fluid replacement">Brake fluid replacement</option>
                            <option value="Brake caliper cleaning">Brake caliper cleaning</option>
                            <option value="Caliper rebuild">Caliper rebuild</option>
                            <option value="Brake hose replacement">Brake hose replacement</option>
                            <option value="Master cylinder rebuild">Master cylinder rebuild</option>
                            <option value="Disc rotor replacement">Disc rotor replacement</option>
                            <option value="Brake lever replacement">Brake lever replacement</option>
                            <option value="Battery replacement">Battery replacement</option>
                            <option value="Battery charging">Battery charging</option>
                            <option value="Regulator/rectifier replacement">Regulator/rectifier replacement</option>
                            <option value="Stator coil replacement">Stator coil replacement</option>
                            <option value="CDI/ECU replacement">CDI/ECU replacement</option>
                            <option value="Wiring harness repair">Wiring harness repair</option>
                            <option value="Starter motor repair">Starter motor repair</option>
                            <option value="Starter relay replacement">Starter relay replacement</option>
                            <option value="Spark plug cap replacement">Spark plug cap replacement</option>
                            <option value="Fuse replacement">Fuse replacement</option>
                            <option value="Headlight bulb replacement">Headlight bulb replacement</option>
                            <option value="Taillight bulb replacement">Taillight bulb replacement</option>
                            <option value="Signal light bulb replacement">Signal light bulb replacement</option>
                            <option value="Horn replacement">Horn replacement</option>
                            <option value="Switch assembly replacement (handlebar switches)">Switch assembly replacement (handlebar switches)</option>
                            <option value="Voltage test & diagnostics">Voltage test & diagnostics</option>
                            <option value="Front fork oil replacement">Front fork oil replacement</option>
                            <option value="Front fork seal replacement">Front fork seal replacement</option>
                            <option value="Shock absorber replacement">Shock absorber replacement</option>
                            <option value="Steering bearing replacement">Steering bearing replacement</option>
                            <option value="Swing arm bushing replacement">Swing arm bushing replacement</option>
                            <option value="Suspension tuning">Suspension tuning</option>
                            <option value="Tire replacement">Tire replacement</option>
                            <option value="Inner tube replacement">Inner tube replacement</option>
                            <option value="Tire vulcanizing">Tire vulcanizing</option>
                            <option value="Wheel balancing">Wheel balancing</option>
                            <option value="Wheel alignment">Wheel alignment</option>
                            <option value="Rim repair (bengkong repair)">Rim repair (bengkong repair)</option>
                            <option value="Spoke tightening/truing">Spoke tightening/truing</option>
                            <option value="Wheel bearing replacement">Wheel bearing replacement</option>
                            <option value="Side mirror replacement">Side mirror replacement</option>
                            <option value="Handlebar replacement">Handlebar replacement</option>
                            <option value="Footrest replacement">Footrest replacement</option>
                            <option value="Brake lever replacement">Brake lever replacement</option>
                            <option value="Clutch lever replacement">Clutch lever replacement</option>
                            <option value="Seat foam repair">Seat foam repair</option>
                            <option value="Seat cover replacement">Seat cover replacement</option>
                            <option value="Body fairing repair">Body fairing repair</option>
                            <option value="Body paint refresh">Body paint refresh</option>
                            <option value="Windshield replacement">Windshield replacement</option>
                            <option value="License plate holder replacement">License plate holder replacement</option>
                            <option value="Crash guard installation">Crash guard installation</option>
                            <option value="Top box installation">Top box installation</option>
                            <option value="Underbone frame welding">Underbone frame welding</option>
                        </select>
                        @error('last_service_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="submit" class="btn btn-primary btn-lg">Add Motorcycle</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Set default date to today
        const dateInput = document.getElementById('last_service_date');
        if (dateInput && !dateInput.value) {
            dateInput.value = new Date().toISOString().split('T')[0];
        }
        
        // Handle brand and model dropdowns
        const brands = @json($brands ?? []);
        const brandSelect = document.getElementById('motorcycle_brand');
        const modelSelect = document.getElementById('motorcycle_model');
        const newBrandContainer = document.getElementById('newBrandContainer');
        const newModelContainer = document.getElementById('newModelContainer');

        // Function to update models based on selected brand
        function updateModels(selectedBrand) {
            if (!modelSelect) return;
            
            // Store the current selected model (if any)
            const currentModel = modelSelect.value;
            
            // Clear existing options
            modelSelect.innerHTML = '<option value="" selected>-- Select Model --</option>';
            
            if (selectedBrand && selectedBrand !== 'other' && brands[selectedBrand]) {
                // Sort models alphabetically
                const sortedModels = [...brands[selectedBrand]].sort();
                
                // Add new options
                sortedModels.forEach(function(model) {
                    const option = document.createElement('option');
                    option.value = model;
                    option.textContent = model;
                    if (currentModel === model) {
                        option.selected = true;
                    }
                    modelSelect.appendChild(option);
                });
                
                // Add 'Other' option
                const otherOption = document.createElement('option');
                otherOption.value = 'other';
                otherOption.textContent = 'Other (Specify)';
                if (currentModel === 'other') {
                    otherOption.selected = true;
                }
                modelSelect.appendChild(otherOption);
                
                modelSelect.disabled = false;
                
                // If there's a selected model from form validation, select it
                if (currentModel && currentModel !== 'other') {
                    const option = modelSelect.querySelector(`option[value="${currentModel}"]`);
                    if (option) {
                        option.selected = true;
                    }
                }
            } else {
                modelSelect.disabled = true;
            }
        }

        // Initialize the model dropdown when the page loads
        if (brandSelect && modelSelect) {
            // Set up the change event handler for the brand dropdown
            brandSelect.addEventListener('change', function() {
                const selectedBrand = this.value;
                
                // Show/hide new brand input
                if (selectedBrand === 'other') {
                    newBrandContainer.style.display = 'block';
                    document.getElementById('new_brand').setAttribute('required', 'required');
                    modelSelect.disabled = true;
                    // Clear model select when 'Other' is selected for brand
                    modelSelect.innerHTML = '<option value="" selected>-- Select Model --</option>';
                } else {
                    newBrandContainer.style.display = 'none';
                    document.getElementById('new_brand').removeAttribute('required');
                    updateModels(selectedBrand);
                }
            });
            
            // If there's a selected brand on page load (from form validation), update models
            if (brandSelect.value) {
                updateModels(brandSelect.value);
            }
            
            // Handle model select change for 'Other' option
            modelSelect.addEventListener('change', function() {
                if (this.value === 'other') {
                    newModelContainer.style.display = 'block';
                    document.getElementById('new_model').setAttribute('required', 'required');
                } else {
                    newModelContainer.style.display = 'none';
                    document.getElementById('new_model').removeAttribute('required');
                }
            });
            
            // Show new brand input if 'Other' is selected for brand (from form validation)
            if (brandSelect.value === 'other') {
                newBrandContainer.style.display = 'block';
            }
            
            // If there's a selected model from form validation, select it
            const selectedModel = '{{ old('motorcycle_model') }}';
            if (selectedModel && selectedModel !== 'other') {
                // Small delay to ensure options are populated
                setTimeout(() => {
                    const option = modelSelect.querySelector(`option[value="${selectedModel}"]`);
                    if (option) {
                        option.selected = true;
                    }
                }, 100);
            }
        }
        
        // Handle modal show event
        const addMotorModal = document.getElementById('addMotorModal');
        if (addMotorModal) {
            addMotorModal.addEventListener('show.bs.modal', function(event) {
                // Reset form
                const form = document.getElementById('addMotorForm');
                if (form) {
                    form.reset();
                }
                
                // Set default date to today
                const dateInput = document.getElementById('last_service_date');
                if (dateInput) {
                    dateInput.value = new Date().toISOString().split('T')[0];
                }
                
                // Reset model dropdown and hide new brand/model inputs
                if (modelSelect) {
                    modelSelect.innerHTML = '<option value="" selected>-- Select Model --</option>';
                    modelSelect.disabled = true;
                }
                
                if (newBrandContainer) newBrandContainer.style.display = 'none';
                if (newModelContainer) newModelContainer.style.display = 'none';
                
                // If there's a related target (button that opened the modal)
                const button = event.relatedTarget;
                if (button) {
                    // Update form action URL if service_log_id is provided
                    const serviceLogId = button.getAttribute('data-service-log-id');
                    if (serviceLogId && form) {
                        form.action = form.action.replace(/\/service-logs\/\d+\/add-motor$/, 
                            `/service-logs/${serviceLogId}/add-motor`);
                    }
                    
                    // If there's a selected brand from form validation, update models
                    if (brandSelect.value) {
                        updateModels(brandSelect.value);
                    }
                }
            });
        }
    });
</script>
@endpush
