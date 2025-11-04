<div class="modal fade" id="addStockModal" tabindex="-1" aria-labelledby="addStockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('admin.inventory.addStock', ['id' => $inventory->inventory_id]) }}">
            @csrf
            <div class="modal-content border-0 shadow-lg rounded-3">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title fw-semibold" id="addStockModalLabel">
                        <i class="fas fa-boxes me-2"></i> Add Stock
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="stock_quantity" class="form-label fw-semibold">Quantity to Add</label>
                        <input type="number" 
                               class="form-control form-control-lg" 
                               name="stock_quantity" 
                               id="stock_quantity" 
                               min="1" 
                               placeholder="Enter quantity" 
                               required>
                        <small class="text-muted">Enter the number of items to add to stock.</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-plus me-1"></i> Add Stock
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
