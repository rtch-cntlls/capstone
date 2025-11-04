<div class="modal fade" id="statusServiceModal{{ $service->service_id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('admin.services.status', $service->service_id) }}" method="POST">
            @csrf
            <div class="modal-content shadow-sm border-0">
                <div class="modal-header {{ $service->status === 'Active' ? 'bg-danger' : 'bg-success' }} text-white">
                    <h5 class="modal-title fw-bold">
                        <i class="fa {{ $service->status === 'Active' ? 'fa-ban' : 'fa-check-circle' }} me-2"></i>
                        {{ $service->status === 'Active' ? 'Deactivate Service' : 'Activate Service' }}
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <p class="mb-2">
                        Are you sure you want to 
                        <strong class="{{ $service->status === 'Active' ? 'text-danger' : 'text-success' }}">
                            {{ $service->status === 'Active' ? 'Deactivate' : 'Activate' }}
                        </strong> 
                        this service?
                    </p>
                    <p class="fw-semibold fst-italic text-muted">
                        "{{ $service->name }}"
                    </p>
                </div>
                <div class="modal-footer ">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" 
                            class="btn btn-{{ $service->status === 'Active' ? 'danger' : 'success' }}">
                        Yes, {{ $service->status === 'Active' ? 'Deactivate' : 'Activate' }} Service
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
