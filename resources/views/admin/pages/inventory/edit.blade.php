<div class="modal fade" id="actionModal{{ $product->product_id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <form action="{{ route('admin.inventory.edit', $product->product_id)}}" method="POST">
            @csrf
            <div class="modal-content shadow-sm border-0">
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold">
                        <i class="fa fa-edit me-2 text-primary"></i> Edit product
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Category</label>
                        <input type="text" name="category" value="{{ $product->category->name }}" class="form-control bg-light" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Product Name</label>
                        <input type="text" name="product_name" value="{{ $product->product_name }}" 
                               class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fa fa-check me-1"></i> Update product
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
