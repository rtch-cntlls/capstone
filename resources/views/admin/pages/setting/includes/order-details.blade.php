<h6 class="fw-bold">Order & Payment Settings</h6>
<form action="{{ route('admin.settings.order', $shop->shop_id) }}" method="POST">
    @csrf
    <input type="hidden" name="enable_direct_buy" value="0">
    <div class="mb-3 d-flex align-items-center justify-content-between">
        <label for="delivery_nationwide" class="form-label me-3">Allow Direct Buy</label>
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="enable_direct_buy"
                   name="enable_direct_buy" value="1"
                   onchange="this.form.submit()"
                   {{ old('enable_direct_buy', $shop->enable_direct_buy ?? false) ? 'checked' : '' }}>
        </div>
    </div>
</form>
<form action="{{ route('admin.settings.order', $shop->shop_id) }}" method="POST">
    @csrf
    <div class="mb-3 d-flex align-items-center justify-content-between">
        <label class="form-label me-3">Nationwide Delivery</label>
        <div class="form-check form-switch">
            <input class="form-check-input" type="radio" id="nationwide"
                   name="service_area" value="nationwide"
                   onchange="this.form.submit()"
                   {{ old('service_area', $shop->service_area ?? 'local') === 'nationwide' ? 'checked' : '' }}>
        </div>
    </div>

    <div class="mb-3 d-flex align-items-center justify-content-between">
        <label class="form-label me-3">Within Province</label>
        <div class="form-check form-switch">
            <input class="form-check-input" type="radio" id="province"
                   name="service_area" value="province"
                   onchange="this.form.submit()"
                   {{ old('service_area', $shop->service_area ?? 'local') === 'province' ? 'checked' : '' }}>
        </div>
    </div>

    <div class="mb-3 d-flex align-items-center justify-content-between">
        <label class="form-label me-3">Local Delivery</label>
        <div class="form-check form-switch">
            <input class="form-check-input" type="radio" id="local"
                   name="service_area" value="local"
                   onchange="this.form.submit()"
                   {{ old('service_area', $shop->service_area ?? 'local') === 'local' ? 'checked' : '' }}>
        </div>
    </div>
</form>


@foreach (['cod' => 'Cash on Delivery', 'gcash' => 'GCash'] as $method => $label)
    <form action="{{ route('admin.settings.order', $shop->shop_id) }}" method="POST">
        @csrf
        <input type="hidden" name="payment_{{ $method }}" value="0">
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <label for="payment_{{ $method }}" class="form-label me-3">{{ $label }}</label>
            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="payment_{{ $method }}"
                       name="payment_{{ $method }}" value="1"
                       onchange="this.form.submit()"
                       {{ old("payment_$method", $shop->{"payment_$method"} ?? false) ? 'checked' : '' }}>
            </div>
        </div>
    </form>
@endforeach