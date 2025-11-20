<div class="modal fade" id="logServiceModal" tabindex="-1" aria-labelledby="logServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form action="{{ route('admin.service-logs.store') }}" method="POST" id="logServiceForm">
                @csrf
                <input type="hidden" name="service_id" id="service_id_hidden">
                <div class="modal-header border-0 px-4 pt-4 pb-2">
                    <h5 class="modal-title fw-semibold" id="logServiceModalLabel">Log New Service</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body px-4 pb-4">
                    <div class="d-flex flex-column gap-3">
                        <div class="bg-light rounded-4 p-3">
                            <h6 class="fw-semibold mb-3 text-secondary">Customer Information</h6>
                            <div class="row g-3">
                                <div class="col-md-6" id="customer_name_group">
                                    <label class="form-label fw-medium">Customer Name</label>
                                    <input type="text" id="customer_name" name="customer_name" class="form-control form-control-lg shadow-none @error('customer_name') is-invalid @enderror" placeholder="Juan Dela Cruz">
                                    @error('customer_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6" id="contact_number_group">
                                    <label class="form-label fw-medium">Contact Number</label>
                                    <input type="text" id="contact_number" name="contact_number" class="form-control form-control-lg shadow-none @error('contact_number') is-invalid @enderror" placeholder="09XXXXXXXXX">
                                    @error('contact_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-12" id="gmail_group">
                                    <label class="form-label fw-medium">Gmail</label>
                                    <input type="email" id="gmail" name="gmail" class="form-control form-control-lg shadow-none @error('gmail') is-invalid @enderror" placeholder="example@gmail.com">
                                    @error('gmail') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="bg-light rounded-4 p-3">
                            <h6 class="fw-semibold mb-3 text-secondary">Motorcycle Details</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Brand</label>
                                    <select id="motorcycle_brand" name="motorcycle_brand" class="form-select shadow-none @error('motorcycle_brand') is-invalid @enderror">
                                        <option value="" selected>-- Select Brand --</option>
                                        @foreach($brands as $brand => $models)
                                            <option value="{{ $brand }}">{{ $brand }}</option>
                                        @endforeach
                                    </select>
                                    @error('motorcycle_brand') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Model</label>
                                    <select id="motorcycle_model" name="motorcycle_model" class="form-select shadow-none @error('motorcycle_model') is-invalid @enderror">
                                        <option value="">-- Select Model --</option>
                                    </select>
                                    @error('motorcycle_model') <div class="invalid-feedback">{{ $message }}</div> @enderror

                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Mileage (km)</label>
                                    <input type="number" id="mileage" name="mileage" class="form-control form-control-lg shadow-none 
                                     @error('mileage') is-invalid @enderror" placeholder="ex. 15000" min="0">
                                    @error('mileage') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Service Date</label>
                                    <input type="date" id="service_date" name="service_date" class="form-control form-control-lg shadow-none" value="{{ old('service_date', date('Y-m-d')) }}">
                                </div>
                            </div>
                        </div>
                        <div class="bg-light rounded-4 p-3">
                            <h6 class="fw-semibold mb-3 text-secondary">Service Information</h6>
                            <div class="row g-3">
                                <div class="col-md-12">
                                    <label class="form-label fw-medium">Service Type</label>
                                    <select id="service_id" name="service_id" class="form-select shadow-none  @error('service_id') is-invalid @enderror">
                                        <option value="">-- Select Service Type --</option>
                                        @foreach($services as $service)
                                            <option value="{{ $service->service_id }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('service_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Road Condition (optional)</label>
                                    <select id="road_condition" name="road_condition" class="form-select shadow-none">
                                        <option value="">-- Select Road Condition --</option>
                                        <option>Rough Road</option>
                                        <option>Cement / Concrete Road</option>
                                        <option>Asphalt Road</option>
                                        <option>Mixed Roads</option>
                                        <option value="others">Others</option>
                                    </select>
                                    <input type="text" id="road_condition_other" class="form-control mt-2 shadow-none d-none" placeholder="Specify other road condition">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-medium">Usage Frequency (optional)</label>
                                    <select id="usage_frequency" name="usage_frequency" class="form-select shadow-none">
                                        <option value="">-- Select Usage Frequency --</option>
                                        <option>Daily Use</option>
                                        <option>Seldom Use</option>
                                        <option>Weekly Use</option>
                                        <option value="others">Others</option>
                                    </select>
                                    <input type="text" id="usage_frequency_other" class="form-control mt-2 shadow-none d-none" placeholder="Specify frequency">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4 pt-0">
                    <button type="submit" class="btn btn-primary btn-lg px-4 rounded-3 shadow-sm">Log Service</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg px-4 rounded-3" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
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
            const baseAddUrl = '{{ url('admin/service-logs') }}';
            if (!serviceLogId) {
                console.warn('No serviceLogId provided for add-motor');
            }
            form.action = `${baseAddUrl}/${serviceLogId}/add-motor`;
            if (titleEl) titleEl.textContent = 'Add Motorcycle Service Record';
            if (submitBtn) submitBtn.textContent = 'Add Motorcycle';
            if (customerNameGroup) customerNameGroup.style.display = 'none';
            if (contactNumberGroup) contactNumberGroup.style.display = 'none';
            if (gmailGroup) gmailGroup.style.display = 'none';
            const serviceIdHidden = document.getElementById('service_id_hidden');
            if (serviceIdHidden) serviceIdHidden.value = serviceLogId || '';
            const dateInput = document.getElementById('service_date');
            const typeSelect = document.getElementById('last_service_type');
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
            const dateInput = document.getElementById('service_date');
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
                setDefaultMode();
                if (form) form.reset();
                toggleOther(roadSelect, roadOther);
                toggleOther(usageSelect, usageOther);
            });
        }
    })();
</script>
