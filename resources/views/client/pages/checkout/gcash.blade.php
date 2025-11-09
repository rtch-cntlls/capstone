<div class="modal fade" id="paymentModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Complete Your Payment</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="text-center fw-semibold mb-4">Scan this QR code with GCash and upload your screenshot</p>
                <div class="row g-4 align-items-center">
                    <div class="col-md-6 text-center">
                        <div class="text-muted">
                            <img src="{{ asset('storage/images/gcash-code.jpg') }}" alt="GCash QR" class="img-fluid" style="max-width: 250px;">
                            <p class="m-0"><span class="fw-bold">Gcash Number:</span> 09453590382</p>
                            <p class="m-0"><span class="fw-bold">Account Name:</span> AWRICH C PARAGES</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="amountToPayInput" class="form-label fw-semibold">Amount to Pay:</label>
                            <div class="input-group">
                                <span class="input-group-text bg-primary text-white">₱</span>
                                <span id="amountToPay" class="form-control fw-bold"  >{{ number_format($total, 2) }}</span>
                            </div>
                            <input type="hidden" name="total_amount" id="hiddenTotalAmount" value="{{ $total }}">
                        </div>
                        <div class="mb-3">
                            <label for="paymentProof" class="form-label fw-semibold">Upload Payment Screenshot:</label>
                            <input type="file" name="payment_proof" id="paymentProof" class="form-control" required>
                            <small class="text-muted">Please upload your screenshot for proof.</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pt-0">
                <button type="button" class="btn btn-outline-secondary rounded-pill" data-bs-dismiss="modal">Cancel</button>
                <button type="button" id="confirmPaymentBtn" class="btn btn-primary rounded-pill fw-bold">Confirm Payment</button>
            </div>
        </div>
    </div>
</div>
