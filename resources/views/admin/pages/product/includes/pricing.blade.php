<li class="mb-3 position-relative ps-1">
    <div class="row gx-3 align-items-start">
        <div class="col-auto position-relative z-1 icon">
            <span class="d-flex align-items-center justify-content-center bg-success text-white rounded-circle"
                  style="width: 36px; height: 36px;">
                <i class="fas fa-tags small"></i>
            </span>
        </div>
        <div class="col p-2">
            <h6 class="fw-semibold text-dark">Pricing Information</h6>
            <div class="mt-2 p-3 bg-light rounded">
                <p class="mb-1 text-muted small d-flex justify-content-between">Sale Price:
                    <strong class="text-dark">₱{{ number_format($product->sale_price, 2) }}</strong>
                </p>
                <p class="mb-0 text-muted small d-flex justify-content-between">Cost Price:
                    <strong class="text-dark">₱{{ number_format($product->cost_price, 2) }}</strong>
                </p>
            </div>
        </div>
    </div>
</li>