<div class="modal fade" id="createServiceModal" tabindex="-1" aria-labelledby="createServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow-sm border-0">
            <form action="{{ route('admin.services.store') }}" method="POST">
                @csrf
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-bold" id="createServiceModalLabel">
                        <i class="fa fa-plus-circle me-2"></i> Add New Service
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">Service Name</label>
                                <select name="name" id="name" class="form-select form-select-sm" required>
                                    <option value="" disabled selected>Select a service</option>
                                    @foreach($servicesData as $category)
                                        <optgroup label="{{ $category['category'] }}">
                                            @foreach($category['services'] as $service)
                                                <option value="{{ $service }}">{{ $service }}</option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                <small class="text-muted">Choose from predefined services.</small>
                            </div>

                            <div class="mb-3">
                                <label for="price" class="form-label fw-semibold">Price (₱)</label>
                                <input type="number" step="0.01" class="form-control form-control-sm" 
                                       id="price" name="price" placeholder="e.g., 500.00" required>
                                <small class="text-muted">Enter service price in PHP.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="duration" class="form-label fw-semibold">Estimated Duration</label>
                                <input type="text" class="form-control form-control-sm" id="duration" 
                                       name="duration" placeholder="e.g., 30 mins">
                                <small class="text-muted">Format: 30 mins, 1 hr, etc.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save me-1"></i> Add Service
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
