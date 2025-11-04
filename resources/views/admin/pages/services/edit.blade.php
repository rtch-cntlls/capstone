<div class="modal fade" id="editServiceModal{{ $service->service_id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <form action="{{ route('admin.services.update', $service->service_id) }}" method="POST">
            @csrf
            <div class="modal-content shadow-sm border-0">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold">
                        <i class="fa fa-edit me-2 text-primary"></i> Edit Service
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Service Name</label>
                        <input type="text" name="name" value="{{ $service->name }}" 
                               class="form-control bg-light" readonly>
                        <small class="text-muted">Service name cannot be changed.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Price (₱)</label>
                        <input type="number" step="0.01" name="price" 
                               value="{{ $service->price }}" 
                               class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Duration</label>
                        <input type="text" name="duration" 
                               value="{{ $service->duration }}" 
                               class="form-control" placeholder="e.g. 30 mins, 1 hour">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-check me-1"></i> Update Service
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
