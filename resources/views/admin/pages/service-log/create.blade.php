<div class="modal fade" id="logServiceModal" tabindex="-1" aria-labelledby="logServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-3 shadow-sm border-0">
            <form action="{{ route('admin.service-logs.store') }}" method="POST" class="p-3">
                @csrf
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title fw-bold" id="logServiceModalLabel">Log New Service</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pt-2">
                    <div class="mb-3">
                        <label for="customer_name" class="form-label fw-medium">Customer Name</label>
                        <input type="text" id="customer_name" name="customer_name" class="form-control form-control-lg @error('customer_name') is-invalid @enderror" placeholder="Enter customer name">
                        @error('customer_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="contact_number" class="form-label fw-medium">Contact Number</label>
                        <input type="text" id="contact_number" name="contact_number" class="form-control form-control-lg @error('contact_number') is-invalid @enderror" placeholder="Enter contact number">
                        @error('contact_number')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="service_id" class="form-label fw-medium">Service</label>
                        <select id="service_id" name="service_id" class="form-select  @error('service_id') is-invalid @enderror">
                            <option value="">Select Service</option>
                            @foreach(App\Models\Service::where('status','Active')->get() as $service)
                                <option value="{{ $service->service_id }}" {{ old('service_id') == $service->service_id ? 'selected' : '' }}>
                                    {{ $service->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('service_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="submit" class="btn btn-primary btn-lg">Log Service</button>
                    <button type="button" class="btn btn-outline-secondary btn-lg" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
