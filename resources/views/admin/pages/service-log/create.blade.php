<div class="modal fade" id="logServiceModal" tabindex="-1" aria-labelledby="logServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3 shadow-sm border-0">
            <form action="{{ route('admin.service-logs.store') }}" method="POST" class="p-3" id="logServiceForm">
                @csrf
                <input type="hidden" name="service_id" id="service_id_hidden">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="logServiceModalLabel">Log New Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-2">
                    <div class="mb-3" id="customer_name_group">
                        <label for="customer_name" class="form-label fw-medium">Customer Name</label>
                        <input type="text" id="customer_name" name="customer_name" class="form-control form-control-lg @error('customer_name') is-invalid @enderror" placeholder="Enter customer name">
                        @error('customer_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3" id="contact_number_group">
                        <label for="contact_number" class="form-label fw-medium">Contact Number</label>
                        <input type="text" id="contact_number" name="contact_number" class="form-control form-control-lg @error('contact_number') is-invalid @enderror" placeholder="Enter contact number">
                        @error('contact_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3" id="gmail_group">
                        <label for="gmail" class="form-label fw-medium">Gmail (optional)</label>
                        <input type="email" id="gmail" name="gmail" class="form-control form-control-lg @error('gmail') is-invalid @enderror" placeholder="Enter Gmail address">
                        @error('gmail')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <hr>
                    <div class="mb-3">
                        <label for="motorcycle_brand" class="form-label fw-medium">Motorcycle Brand (optional)</label>
                        <select id="motorcycle_brand" name="motorcycle_brand" class="form-select @error('motorcycle_brand') is-invalid @enderror">
                            <option value="" selected>-- Select Brand --</option>
                            @foreach($brands as $brand => $models)
                                <option value="{{ $brand }}" {{ old('motorcycle_brand') == $brand ? 'selected' : '' }}>{{ $brand }}</option>
                            @endforeach
                        </select>
                        @error('motorcycle_brand')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="motorcycle_model" class="form-label fw-medium">Motorcycle Model (optional)</label>
                        <select id="motorcycle_model" name="motorcycle_model" class="form-select @error('motorcycle_model') is-invalid @enderror">
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
                        <input type="number" id="last_mileage" name="last_mileage" class="form-control form-control-lg @error('last_mileage') is-invalid @enderror" placeholder="Enter last service mileage" min="0">
                        @error('last_mileage')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="last_service_date" class="form-label fw-medium">Service Date</label>
                        <input type="date" id="last_service_date" name="last_service_date" 
                            class="form-control form-control-lg @error('last_service_date') is-invalid @enderror"
                            value="{{ old('last_service_date', date('Y-m-d')) }}" readonly>
                        @error('last_service_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>                    
                    <div class="mb-3">
                        <label for="last_service_type" class="form-label fw-medium">Service Type</label>
                        <select id="service_id" name="service_id" 
                            class="form-select @error('service_id') is-invalid @enderror">
                            <option value="">-- Select Service Type --</option>
                            @foreach($services as $service)
                                <option value="{{ $service->service_id }}"
                                    {{ old('service_id') == $service->service_id ? 'selected' : '' }}>
                                    {{ $service->name }}
                                </option>
                            @endforeach
                        </select>   
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Road Condition</label>
                        <select id="road_condition" name="road_condition" class="form-select">
                            <option value="" selected>-- Select Road Condition --</option>
                            <option value="Rough Road">Rough Road</option>
                            <option value="Cement / Concrete Road">Cement / Concrete Road</option>
                            <option value="Asphalt Road">Asphalt Road</option>
                            <option value="Mixed Roads">Mixed Roads</option>
                            <option value="others">Others</option>
                        </select>
                        <input type="text" id="road_condition_other" name="road_condition_other" class="form-control mt-2 d-none" placeholder="Specify other road condition">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-medium">Usage Frequency</label>
                        <select id="usage_frequency" name="usage_frequency" class="form-select">
                            <option value="" selected>-- Select Usage Frequency --</option>
                            <option value="Daily Use">Daily Use</option>
                            <option value="Seldom Use">Seldom Use</option>
                            <option value="Weekly Use">Weekly Use</option>
                            <option value="others">Others</option>
                        </select>
                        <input type="text" id="usage_frequency_other" name="usage_frequency_other" class="form-control mt-2 d-none" placeholder="Specify other usage frequency">
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="submit" class="btn btn-primary btn-lg" id="logServiceSubmitBtn">Log Service</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        (function() {
            const brands = @json($brands ?? []);
            const brandSelect = document.getElementById('motorcycle_brand');
            const modelSelect = document.getElementById('motorcycle_model');
            const modal = document.getElementById('logServiceModal');
            const form = document.getElementById('logServiceForm');
            const titleEl = document.getElementById('logServiceModalLabel');
            const submitBtn = document.getElementById('logServiceSubmitBtn');
            const customerNameGroup = document.getElementById('customer_name_group');
            const contactNumberGroup = document.getElementById('contact_number_group');
            const gmailGroup = document.getElementById('gmail_group');

            // Populate models when brand changes
            if (brandSelect && modelSelect) {
                brandSelect.addEventListener('change', function () {
                    const selectedBrand = this.value;
                    modelSelect.innerHTML = '<option value="" selected>-- Select Model --</option>';
                    if (selectedBrand && brands[selectedBrand]) {
                        brands[selectedBrand].forEach(function(model) {
                            const option = document.createElement('option');
                            option.value = model;
                            option.textContent = model;
                            modelSelect.appendChild(option);
                        });
                    }
                });
            }

            const roadSelect = document.getElementById('road_condition');
            const roadOther = document.getElementById('road_condition_other');
            const usageSelect = document.getElementById('usage_frequency');
            const usageOther = document.getElementById('usage_frequency_other');
            function toggleOther(selectEl, inputEl) {
                if (!selectEl || !inputEl) return;
                inputEl.classList.toggle('d-none', selectEl.value !== 'others');
                if (selectEl.value !== 'others') inputEl.value = '';
            }
            if (roadSelect && roadOther) {
                roadSelect.addEventListener('change', () => toggleOther(roadSelect, roadOther));
            }
            if (usageSelect && usageOther) {
                usageSelect.addEventListener('change', () => toggleOther(usageSelect, usageOther));
            }

            function setAddMotorMode(serviceLogId) {
                if (!form) return;
                // Change action to add-motor route with id
                const baseAddUrl = '{{ url('admin/service-logs') }}';
                if (!serviceLogId) {
                    console.warn('No serviceLogId provided for add-motor');
                }
                form.action = `${baseAddUrl}/${serviceLogId}/add-motor`;
                // UI text
                if (titleEl) titleEl.textContent = 'Add Motorcycle Service Record';
                if (submitBtn) submitBtn.textContent = 'Add Motorcycle';
                // Hide customer fields
                if (customerNameGroup) customerNameGroup.style.display = 'none';
                if (contactNumberGroup) contactNumberGroup.style.display = 'none';
                if (gmailGroup) gmailGroup.style.display = 'none';
                // Set hidden service id
                const serviceIdHidden = document.getElementById('service_id_hidden');
                if (serviceIdHidden) serviceIdHidden.value = serviceLogId || '';
                // Make motorcycle fields required
                if (brandSelect) brandSelect.required = true;
                if (modelSelect) modelSelect.required = true;
                const dateInput = document.getElementById('last_service_date');
                const typeSelect = document.getElementById('last_service_type');
                if (dateInput) dateInput.required = true;
                if (typeSelect) typeSelect.required = true;
                // Default date today if empty
                if (dateInput && !dateInput.value) {
                    dateInput.value = new Date().toISOString().split('T')[0];
                }
            }

            function setDefaultMode() {
                if (!form) return;
                form.action = '{{ route('admin.service-logs.store') }}';
                if (titleEl) titleEl.textContent = 'Log New Service';
                if (submitBtn) submitBtn.textContent = 'Log Service';
                if (customerNameGroup) customerNameGroup.style.display = '';
                if (contactNumberGroup) contactNumberGroup.style.display = '';
                if (gmailGroup) gmailGroup.style.display = '';
                const serviceIdHidden = document.getElementById('service_id_hidden');
                if (serviceIdHidden) serviceIdHidden.value = '';
                // Require fields needed for AI prediction
                if (brandSelect) brandSelect.required = true;
                if (modelSelect) modelSelect.required = true;
                const dateInput = document.getElementById('last_service_date');
                const typeSelect = document.getElementById('last_service_type');
                if (dateInput) {
                    dateInput.required = true;
                    if (!dateInput.value) dateInput.value = new Date().toISOString().split('T')[0];
                }
                if (typeSelect) typeSelect.required = true;
            }

            if (modal) {
                modal.addEventListener('show.bs.modal', function (event) {
                    const button = event.relatedTarget;
                    const mode = button ? button.getAttribute('data-mode') : null;
                    if (mode === 'add-motor') {
                        const serviceLogId = button.getAttribute('data-service-log-id');
                        setAddMotorMode(serviceLogId);
                    } else {
                        setDefaultMode();
                    }
                });
                modal.addEventListener('hidden.bs.modal', function () {
                    // Reset to default when closed
                    setDefaultMode();
                    if (form) form.reset();
                    toggleOther(roadSelect, roadOther);
                    toggleOther(usageSelect, usageOther);
                });
            }
        })();
    </script>
</div>
