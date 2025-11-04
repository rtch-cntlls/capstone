<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true" data-order-total="{{ $subtotal }}">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.pos.checkout') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">Complete Checkout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Enter Amount Paid</label>
                        <input type="number" id="amount_paid" name="amount_paid" class="form-control text-end fs-5 fw-bold" step="0.01" required>
                    </div>
                    <div class="d-grid gap-2">
                        <div class="d-flex">
                            <button type="button" class="btn btn-light flex-fill fs-5" onclick="pressNum('7')">7</button>
                            <button type="button" class="btn btn-light flex-fill fs-5" onclick="pressNum('8')">8</button>
                            <button type="button" class="btn btn-light flex-fill fs-5" onclick="pressNum('9')">9</button>
                        </div>
                        <div class="d-flex">
                            <button type="button" class="btn btn-light flex-fill fs-5" onclick="pressNum('4')">4</button>
                            <button type="button" class="btn btn-light flex-fill fs-5" onclick="pressNum('5')">5</button>
                            <button type="button" class="btn btn-light flex-fill fs-5" onclick="pressNum('6')">6</button>
                        </div>
                        <div class="d-flex">
                            <button type="button" class="btn btn-light flex-fill fs-5" onclick="pressNum('1')">1</button>
                            <button type="button" class="btn btn-light flex-fill fs-5" onclick="pressNum('2')">2</button>
                            <button type="button" class="btn btn-light flex-fill fs-5" onclick="pressNum('3')">3</button>
                        </div>
                        <div class="d-flex">
                            <button type="button" class="btn btn-light flex-fill fs-5" onclick="pressNum('0')">0</button>
                            <button type="button" class="btn btn-outline-danger flex-fill fs-5" onclick="clearInput()">C</button>
                        </div>
                    </div>
                   <div class="mt-3 d-flex justify-content-between">
                        <span class="fw-bold">Total:</span>
                        <span class="text-success" id="orderTotalDisplay">₱{{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div id="change_display" class="mt-2 fw-bold"></div>
                    <input type="hidden" id="change" name="change">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success w-100">
                        <span class="btn-text">Confirm Payment</span>
                        <span class="btn-loader spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    window.orderTotal = {{ $subtotal }};
</script>
<script src="{{ asset('script/button.js')}}"></script>
