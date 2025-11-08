@extends('client.layouts.clientNoFooter')
@section('content')
@include('components.ModalAlertSuccess')
@include('components.ModalAlertError')
<div class="container">
    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        @if(session('error'))
            {{ session('error') }}
        @endif
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <a href="{{ route('checkout.cancel') }}" class="text-decoration-none">
        <i class="fas fa-arrow-left me-1"></i>Back
    </a>
    <form action="{{ route('checkout.placeOrder') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                @include('client.pages.checkout.includes.personal')
                @include('client.pages.checkout.includes.address')
                @include('client.pages.checkout.includes.delivery')
                @include('client.pages.checkout.includes.payment')
            </div>
            <div class="col-lg-4 d-none d-lg-flex flex-column">
                <h4 class="fw-bold text-danger mb-3">Product Checkout</h4>
                <div class="card p-3 d-flex flex-column shadow-sm" style="height: 600px;">
                    @if(!empty($order))
                        @php
                            $isMultiple = isset($order[0]); 
                            $total = 0;
                        @endphp
                        <div class="flex-grow-1 overflow-auto">
                            @if($isMultiple)
                                @foreach($order as $item)
                                    @php $total += $item['subtotal']; @endphp
                                    <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="{{ !empty($item['image']) ? asset('storage/' . $item['image']) : asset('images/placeholder.png') }}" 
                                                width="40" class="rounded">
                                            <div style="font-size:13px; max-width:160px;">{{ $item['product_name'] }}</div>
                                        </div>
                                        <div class="d-flex gap-2 align-items-center">
                                            <div style="font-size:12px;">x{{ $item['quantity'] }}</div>
                                            <div>₱{{ number_format($item['subtotal'],2) }}</div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                @php $total = $order['subtotal']; @endphp
                                <div class="d-flex justify-content-between align-items-center py-2 border-bottom">
                                    <div class="d-flex align-items-center gap-2">
                                        <img src="{{ !empty($order['image']) ? asset('storage/' . $order['image']) : asset('storage/images/placeholder.png') }}" 
                                             width="40" class="rounded" alt="">
                                        <div style="font-size:13px; max-width:160px;">{{ $order['product_name'] }}</div>
                                    </div>
                                    <div class="d-flex gap-2 align-items-center">
                                        <div style="font-size:12px;">x{{ $order['quantity'] }}</div>
                                        <div>₱{{ number_format($order['subtotal'],2) }}</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="mt-auto pt-2">
                            <div class="d-flex fw-bold border-top py-2">
                                <div class="flex-fill">Overall Total</div>
                                <div class="flex-fill text-center"></div>
                                <div class="flex-fill text-end text-primary">₱{{ number_format($total,2) }}</div>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('checkout.cancel') }}" class="btn btn-outline-secondary rounded-pill w-100 me-2">
                                    Cancel
                                </a>
                                <button type="button" id="placeOrderDesktop" class="btn btn-success rounded-pill w-100" disabled>Place Order</button>
                            </div>  
                            <div class="form-check my-3">
                                <input class="form-check-input agreeTerms" type="checkbox" id="agreeTermsDesktop" required>
                                <label class="form-check-label" for="agreeTermsDesktop">
                                    I agree to the <a href="{{ route('footer.termsAndCondition') }}" target="_blank">Terms and Conditions</a> and 
                                    <a href="{{ route('footer.privacy') }}" target="_blank">Privacy Policy</a>.
                                </label>
                            </div>     
                        </div>
                    @else
                        <div class="text-center flex-grow-1 d-flex flex-column justify-content-center">
                            <img src="{{ asset('images/cart.gif') }}" width="180" class="mx-auto mb-2">
                            <p class="text-muted">No products selected.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @if(!empty($order))
            <div class="d-lg-none position-fixed bottom-0 start-0 end-0 bg-white border-top shadow-lg p-2" style="z-index: 1050;">
                <div class="d-flex justify-content-between align-items-center" id="mobileCheckoutToggle" style="cursor:pointer;">
                    <div>
                        <span class="fw-bold">Total: ₱{{ number_format($isMultiple ? collect($order)->sum('subtotal') : $order['subtotal'],2) }}</span>
                        <small class="text-muted d-block">Tap to view products</small>
                    </div>
                    <i class="fas fa-chevron-up" id="mobileCheckoutIcon"></i>
                </div>
                <div id="mobileCheckoutDetails" class="mt-2 p-3" style="display:none; max-height: 300px; overflow-auto;">
                    @if($isMultiple)
                        @foreach($order as $item)
                            <div class="d-flex justify-content-between py-2 border-bottom align-items-center">
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ !empty($item['image']) ? asset('storage/' . $item['image']) : asset('images/placeholder.png') }}" 
                                         width="35" class="rounded">
                                    <div style="font-size:12px; max-width:150px;">{{ $item['product_name'] }}</div>
                                </div>
                                <div class="d-flex gap-2">
                                    <div style="font-size:12px;">x{{ $item['quantity'] }}</div>
                                    <div>₱{{ number_format($item['subtotal'],2) }}</div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="d-flex justify-content-between py-2 border-bottom align-items-center">
                            <div class="d-flex align-items-center gap-2">
                                <img src="{{ !empty($order['image']) ? asset($order['image']) : asset('images/placeholder.png') }}" width="35" class="rounded">
                                <div style="font-size:12px; max-width:150px;">{{ $order['product_name'] }}</div>
                            </div>
                            <div class="d-flex gap-2">
                                <div style="font-size:12px;">x{{ $order['quantity'] }}</div>
                                <div>₱{{ number_format($order['subtotal'],2) }}</div>
                            </div>
                        </div>
                    @endif
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('checkout.cancel') }}" class="btn btn-outline-secondary rounded-pill w-100 me-2">
                            Cancel
                        </a>
                        <button type="button" id="placeOrderMobile" class="btn btn-success rounded-pill w-100" disabled>Place Order</button>
                    </div>     
                    <div class="form-check my-3 d-lg-none">
                        <input class="form-check-input agreeTerms" type="checkbox" id="agreeTermsMobile" required>
                        <label class="form-check-label" for="agreeTermsMobile">
                            I agree to the <a href="{{ route('footer.termsAndCondition') }}" target="_blank">Terms and Conditions</a> and 
                            <a href="{{ route('footer.privacy') }}" target="_blank">Privacy Policy</a>.
                        </label>
                    </div>                
                </div>
            </div>
        @endif
        @include('client.pages.checkout.gcash')       
    </form>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function(){
        const toggle = document.getElementById('mobileCheckoutToggle');
        const details = document.getElementById('mobileCheckoutDetails');
        const icon = document.getElementById('mobileCheckoutIcon');
        if(toggle){
            toggle.addEventListener('click', function(){
                if(details.style.display === 'none'){
                    details.style.display = 'block';
                    icon.classList.remove('fa-chevron-up');
                    icon.classList.add('fa-chevron-down');
                } else {
                    details.style.display = 'none';
                    icon.classList.remove('fa-chevron-down');
                    icon.classList.add('fa-chevron-up');
                }
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
    const placeOrderBtns = [
        document.getElementById('placeOrderDesktop'),
        document.getElementById('placeOrderMobile')
    ].filter(Boolean);

    const confirmPaymentBtn = document.getElementById('confirmPaymentBtn');
    const checkoutForm = document.querySelector('form[action="{{ route('checkout.placeOrder') }}"]');
    const paymentModalEl = document.getElementById('paymentModal');
    const paymentModal = new bootstrap.Modal(paymentModalEl);
    const payLaterCheckbox = document.getElementById('payLater');

    placeOrderBtns.forEach(btn => {
        btn.addEventListener('click', function () {
            if (payLaterCheckbox && payLaterCheckbox.checked) {
                checkoutForm.submit();
                return;
            }

            const selectedPayment = document.querySelector('input[name="payment_method"]:checked');
            if (!selectedPayment) {
                alert('Please select a payment method.');
                return;
            }

            if (selectedPayment.value === 'gcash') {
                paymentModal.show();
            } else {
                checkoutForm.submit();
            }
        });
    });

    confirmPaymentBtn.addEventListener('click', function () {
        const fileInput = document.getElementById('paymentProof');
        if (!fileInput.files.length) {
            alert('Please upload your payment screenshot.');
            return;
        }

        const existingInput = checkoutForm.querySelector('input[name="payment_proof"]');
        if (existingInput) existingInput.remove();

        const hiddenFileInput = document.createElement('input');
        hiddenFileInput.type = 'file';
        hiddenFileInput.name = 'payment_proof';
        hiddenFileInput.files = fileInput.files;
        hiddenFileInput.style.display = 'none';
        checkoutForm.appendChild(hiddenFileInput);

        checkoutForm.submit();
    });
});

document.addEventListener('DOMContentLoaded', function () {
    const placeOrderBtns = [
        document.getElementById('placeOrderDesktop'),
        document.getElementById('placeOrderMobile')
    ].filter(Boolean);

    placeOrderBtns.forEach(btn => btn.disabled = true);

    const agreeCheckboxes = document.querySelectorAll('.agreeTerms');

    agreeCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            const anyChecked = Array.from(agreeCheckboxes).some(cb => cb.checked);
            placeOrderBtns.forEach(btn => btn.disabled = !anyChecked);
        });
    });
});


</script>
<script src="{{ asset('script/address.js') }}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deliveryRadio = document.getElementById('delivery');
        const pickUpRadio = document.getElementById('pick_up');
        const provinceSelect = document.getElementById('provinceSelect');
        const citySelect = document.getElementById('citySelect');
        const deliveryFeeInput = document.getElementById('deliveryFeeInput');

        const amountToPayEl = document.getElementById('amountToPay');
        const hiddenTotal = document.getElementById('hiddenTotalAmount');

        const baseTotal = parseFloat("{{ $total }}");

        function getDynamicFee() {
            return parseFloat(deliveryFeeInput.value || 0);
        }

        function updateAmount() {
            let total = baseTotal;

            if (deliveryRadio && deliveryRadio.checked) {
                total += getDynamicFee();
            }

            if (amountToPayEl) amountToPayEl.textContent = total.toFixed(2);
            if (hiddenTotal) hiddenTotal.value = total.toFixed(2);
        }

        deliveryRadio?.addEventListener('change', updateAmount);
        pickUpRadio?.addEventListener('change', updateAmount);
        provinceSelect?.addEventListener('change', updateAmount);
        citySelect?.addEventListener('change', updateAmount);

        updateAmount();
    });
    
</script>
    
@endsection
