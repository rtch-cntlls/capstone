<div class="modal fade" id="addDiscountModal" tabindex="-1" aria-labelledby="addDiscountModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('admin.product.discount', ['id' => $product->product_id]) }}">
            @csrf
            <div class="modal-content border-0 shadow">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title fw-semibold" id="addDiscountModalLabel">Apply Product Discount</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Product Name</label>
                        <input type="text" class="form-control" value="{{ $product->product_name }}" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Select Discount Percentage</label>
                        <div class="d-flex flex-wrap gap-2 justify-content-center mt-2">
                            @foreach([5, 10, 15, 20, 25, 30, 35, 40, 45, 50] as $percent)
                                <input type="radio" class="btn-check" name="discount_percent" id="discount_{{ $percent }}" value="{{ $percent }}" >
                                <label class="btn btn-outline-danger btn-sm px-3 py-1" for="discount_{{ $percent }}">{{ $percent }}%</label>
                            @endforeach
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="start_date" class="form-label fw-bold">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control" >
                    </div>
                    <div class="mb-3">
                        <label for="expiry_date" class="form-label fw-bold">Expiry Date</label>
                        <input type="date" name="expiry_date" id="expiry_date" class="form-control" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger btn-sm">Apply Discount</button>
                </div>

            </div>
        </form>
    </div>
</div>
