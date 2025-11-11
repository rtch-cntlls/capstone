<h6 class="fw-bold">Order & Payment Settings</h6>

<form action="{{ route('admin.settings.order', $shop->shop_id) }}" method="POST">
    @csrf
    <input type="hidden" name="enable_direct_buy" value="0">
    <div class="mb-3 d-flex align-items-center justify-content-between">
        <label for="enable_direct_buy" class="form-label me-3">Allow Direct Buy</label>
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
    @foreach (['nationwide' => 'Nationwide Delivery', 'province' => 'Within Province', 'local' => 'Local Delivery'] as $value => $label)
        <div class="mb-3 d-flex align-items-center justify-content-between">
            <label class="form-label me-3">{{ $label }}</label>
            <div class="form-check form-switch">
                <input class="form-check-input" type="radio" name="service_area"
                       value="{{ $value }}" onchange="this.form.submit()"
                       {{ old('service_area', $shop->service_area ?? 'local') === $value ? 'checked' : '' }}>
            </div>
        </div>
    @endforeach
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
