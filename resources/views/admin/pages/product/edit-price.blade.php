<div class="modal fade" id="editPricingModal" tabindex="-1" aria-labelledby="editPricingLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-sm">
            <div class="modal-header bg-primary text-white">
                <h6 class="modal-title fw-bold" id="editPricingLabel">
                    <i class="fa fa-pen me-2"></i>Edit Pricing
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.product.updatePricing', $product->product_id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="cost_price" class="form-label fw-semibold">Cost Price</label>
                        <input type="number" name="cost_price" id="cost_price" step="0.01" min="0"
                            value="{{ old('cost_price', $product->cost_price) }}"
                            class="form-control @error('cost_price') is-invalid @enderror" required>
                        @error('cost_price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="sale_price" class="form-label fw-semibold">Sale Price</label>
                        <input type="number" name="sale_price" id="sale_price" step="0.01" min="0"
                            value="{{ old('sale_price', $product->sale_price) }}"
                            class="form-control @error('sale_price') is-invalid @enderror" required>
                        @error('sale_price')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light border" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-success fw-bold">
                        <i class="fa fa-save me-1"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
