<div class="my-3">
    <h4 class="fw-bold">Payment Method</h4>
    @error('payment_method')
        <div class="mb-2">
            <small class="text-danger">{{ $message }}</small>
        </div>
    @enderror
    <div class="row">
        @if($shop->payment_gcash)
            <div class="col-md-6 mb-2">
                <label class="w-100">
                    <input type="radio" class="btn-check" name="payment_method" id="gcash" value="gcash" autocomplete="off">
                    <div class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-between p-3 rounded payment-option">
                        <span><i class="fas fa-wallet me-2"></i> GCash</span>
                        <img src="{{ asset('images/gcash.png')}}" alt="GCash" width="40">
                    </div>
                </label>
            </div>
        @endif
        @if($shop->payment_cod)
            <div class="col-md-6 mb-2">
                <label class="w-100">
                    <input type="radio" class="btn-check" name="payment_method" id="cod" value="cod" autocomplete="off">
                    <div class="btn btn-outline-dark w-100 d-flex align-items-center justify-content-between p-3 rounded payment-option">
                        <span><i class="fas fa-box me-2"></i> Cash on Delivery</span>
                        <img src="{{ asset('images/cod.png')}}" alt="COD" width="85">
                    </div>
                </label>
            </div>
        @endif
    </div>
</div>
