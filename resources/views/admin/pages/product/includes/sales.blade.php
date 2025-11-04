<li class="mb-3 position-relative ps-1">
    <div class="row gx-3 align-items-start">
        <div class="col-auto position-relative z-1 icon">
            <span class="d-flex align-items-center justify-content-center bg-secondary text-white rounded-circle"
                  style="width: 36px; height: 36px;">
                <i class="fas fa-cash-register small"></i>
            </span>
        </div>
        <div class="col p-2">
            <h6 class="fw-semibold text-dark">Sales Information</h6>
            <div class="mt-2 p-3 bg-light rounded">
                <p class="mb-1 text-muted small d-flex justify-content-between">Total Sold:
                    <strong class="text-dark">{{ $product->saleItems()->sum('quantity') }} pc/s</strong>
                </p>
                <p class="mb-0 text-muted small d-flex justify-content-between">Remaining Inventory:
                    <strong class="text-dark">{{ $product->inventory->available_stock ?? 0 }} pc/s</strong>
                </p>
            </div>
        </div>
    </div>
</li>  