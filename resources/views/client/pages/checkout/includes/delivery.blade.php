<div class="my-3">
    <h4 class="fw-bold"><i class="fas fa-boxes me-2"></i>Delivery Type</h4>
    <div class="row g-2">
        <div class="col-6 col-md-6">
            <label class="w-100 delivery-option">
                <input type="radio" class="btn-check" name="delivery_type" id="pick_up"
                       value="pick-up" autocomplete="off">
                <div class="card option-card text-center p-3 h-100">
                    <i class="fas fa-store fa-2x mb-2"></i>
                    <h6 class="fw-semibold mb-1">Self Pick Up</h6>
                    <small class="text-muted d-block mt-1">Collect from store</small>
                </div>
            </label>
        </div>
        <div class="col-6 col-md-6">
            <label class="w-100 delivery-option">
                <input type="radio" class="btn-check" name="delivery_type" id="delivery"
                       value="deliver" autocomplete="off">
                <div class="card option-card text-center p-3 h-100">
                    <i class="fas fa-truck fa-2x mb-2"></i>
                    <h6 class="fw-semibold mb-1">Delivery</h6>
                    <small class="text-muted d-block mt-1">Delivered to your address</small>
                </div>
            </label>
        </div>
    </div>
    <div class="card p-3 mt-3 d-none" id="deliveryFeeSection">
        <div class="d-flex justify-content-between align-items-center">
            <div>Delivery Fee:</div>
            <input type="hidden" name="delivery_fee" id="deliveryFeeInput" value="0">
            <div class="text-danger fw-bold" id="deliveryFeeText">₱0.00</div>
        </div><hr>
        <div class="d-flex justify-content-between align-items-center">
            <div>Courier:</div>
            <div class="text-danger fw-bold" id="deliveryFeeText">J&T Express</div>
        </div>
    </div>
    <div class="card p-3 mt-3 d-none" id="payLaterSection">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="pay_later" id="payLater">
            <label class="form-check-label fw-semibold" for="payLater">
                Pay Later
            </label>
        </div>
    </div>
</div>
<script>
    window.shopData = {
        shippingFees: {
            local: {{ $shop->shipping_fee_local ?? 0 }},
            province: {{ $shop->shipping_fee_province ?? 0 }},
            luzon: {{ $shop->shipping_fee_luzon ?? 0 }},
            visayas: {{ $shop->shipping_fee_visayas ?? 0 }},
            mindanao: {{ $shop->shipping_fee_mindanao ?? 0 }}
        },
        serviceArea: "{{ strtolower($shop->service_area ?? '') }}",
        province: "{{ strtolower($shop->province ?? '') }}",
        city: "{{ strtolower($shop->city ?? '') }}"
    };
    window.totalWeightKg = {{ isset($totalWeightKg) ? number_format($totalWeightKg, 3, '.', '') : 0 }};
    window.JTRates = {
        brackets: [
            { key: '0_0_5kg', min: 0.0, max: 0.5 },
            { key: '0_5_1kg', min: 0.5, max: 1.0 },
            { key: '1_3kg',   min: 1.0, max: 3.0 },
            { key: '3_4kg',   min: 3.0, max: 4.0 },
            { key: '4_5kg',   min: 4.0, max: 5.0 },
            { key: '5_6kg',   min: 5.0, max: 6.0 },
        ],
        rates: {
            Visayas: {
                '0_0_5kg': 85,  '0_5_1kg': 150, '1_3kg': 180,
                '3_4kg': 270,   '4_5kg': 360,   '5_6kg': 455,
            },
            Manila: {
                '0_0_5kg': 100, '0_5_1kg': 180, '1_3kg': 200,
                '3_4kg': 300,   '4_5kg': 400,   '5_6kg': 500,
            },
            Luzon: {
                '0_0_5kg': 100, '0_5_1kg': 180, '1_3kg': 200,
                '3_4kg': 300,   '4_5kg': 400,   '5_6kg': 500,
            },
            Mindanao: {
                '0_0_5kg': 105, '0_5_1kg': 175, '1_3kg': 200,
                '3_4kg': 280,   '4_5kg': 380,   '5_6kg': 475,
            },
            Island: {
                '0_0_5kg': 115, '0_5_1kg': 185, '1_3kg': 210,
                '3_4kg': 300,   '4_5kg': 390,   '5_6kg': 485,
            },
        }
    };
</script>
<script src="{{ asset('script/customer/delivery.js')}}"></script>    
<script src="{{ asset('script/customer/shipping-fee.js')}}"></script>