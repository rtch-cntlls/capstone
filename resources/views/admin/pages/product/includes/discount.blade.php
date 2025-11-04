<li class="mb-3 position-relative ps-1">
    <div class="row gx-3 align-items-start">
        <div class="col-auto position-relative z-1 icon">
            <span class="d-flex align-items-center justify-content-center bg-warning text-white rounded-circle"
                  style="width: 36px; height: 36px;">
                <i class="fas fa-percentage small"></i>
            </span>
        </div>
        <div class="col p-2">
            <h6 class="fw-semibold text-dark">Discount</h6>
            @php
                $discount = $product->discounts
                    ->where('status', 'Active')
                    ->where('start_date', '<=', now()->toDateString())
                    ->where('expiry_date', '>=', now()->toDateString())
                    ->first();
            @endphp
            @if ($discount)
                <div class="mt-2 p-3 bg-light rounded">
                    <p class="mb-1 text-muted small d-flex justify-content-between">Discount Percentage:
                        <strong class="text-dark">{{ (int) $discount->discount_percent }}%</strong>
                    </p>
                    <p class="mb-1 text-muted small d-flex justify-content-between">Promo Price:
                        <strong class="text-dark">₱{{ number_format($promoPrice, 2) }}</strong>
                    </p>
                    <p class="mb-1 text-muted small d-flex justify-content-between">Start Date:
                        <strong class="text-success">{{ date('M d, Y', strtotime($discount->start_date)) }}</strong>
                    </p>
                    <p class="mb-1 text-muted small d-flex justify-content-between">Expiry Date:
                        <strong class="text-danger">{{ date('M d, Y', strtotime($discount->expiry_date)) }}</strong>
                    </p>
                </div>
            @else
                <div class="mt-2 p-3 bg-light rounded text-center text-muted small">
                    No discount available for this product today.
                </div>
            @endif                            
        </div>
    </div>
</li>
