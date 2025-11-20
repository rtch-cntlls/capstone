<div class="modal fade" id="addMaintenanceModal" tabindex="-1" aria-labelledby="addMaintenanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3 shadow-sm border-0">
            <form action="{{ route('admin.service-logs.maintenance-logs.store', $baseLog) }}" method="POST" class="p-3">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="addMaintenanceModalLabel">Add New Service Log</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-2">
                    <div class="mb-3">
                        <label class="form-label fw-medium">Motorcycle</label>
                        <input type="text" class="form-control" name="motorcycle"
                            value="{{ $baseLog->motorcycle_brand }} {{ $baseLog->motorcycle_model }}" readonly>
                    </div>                    
                    <div class="mb-3">
                        <label for="last_service_type" class="form-label fw-medium">Service Type</label>
                        <select id="service_id" name="service_id" class="form-select shadow-none  @error('service_id') is-invalid @enderror">
                            <option value="">-- Select Service Type --</option>
                            @foreach($services as $service)
                                <option value="{{ $service->service_id }}">{{ $service->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="mileage" class="form-label fw-medium">Mileage at Service (km)</label>
                        <input type="number" id="mileage" name="mileage" class="form-control form-control-lg" min="0" placeholder="Enter mileage">
                    </div>
                    <div class="mb-3">
                        <label for="service_date" class="form-label fw-medium">Service Date</label>
                        <input type="date" id="service_date" name="service_date" 
                               class="form-control form-control-lg" 
                               value="{{ old('service_date', date('Y-m-d')) }}" readonly>
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
                    <button type="submit" class="btn btn-primary btn-lg">Save & Run AI</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>