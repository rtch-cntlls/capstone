<div class="my-3">
    @error('delivery_type')
        <small class="text-danger">{{ $message }}</small>
    @enderror
    <h4 class="fw-bold"><i class="fas fa-map-marker-alt me-2"></i>Delivery Address</h4>
    <div class="row g-2">
        <div class="col-6 col-md-6 mb-2">
            <label class="small fw-bold">Province</label>
            @php
                $provinceValue = $address->province ?? '';
                $shopProvince = $shop->province ?? '';
                $deliveryType = $shop->service_area ?? '';
            @endphp
            <select class="form-control" name="province" id="provinceSelect"
                @if($deliveryType !== 'nationwide' || !empty($provinceValue)) disabled @endif
                data-value="{{ $provinceValue ?: ($deliveryType !== 'nationwide' ? $shopProvince : '') }}">
                <option value="">Select Province</option>
            </select>
            @if($deliveryType !== 'nationwide' || !empty($provinceValue))
                <input type="hidden" name="province" value="{{ $provinceValue ?: $shopProvince }}">
            @endif
            @error('province')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-6 col-md-6 mb-2">
            <label class="small fw-bold">City / Municipality</label>
            @php
                $cityValue = $address->city ?? '';
                $shopCity = $shop->city ?? '';
            @endphp
            <select class="form-control" name="city" id="citySelect"
                @if($deliveryType === 'local' || !empty($cityValue)) disabled @endif
                data-value="{{ $cityValue ?: ($deliveryType === 'local' ? $shopCity : '') }}">
                <option value="">Select City</option>
            </select>
            @if($deliveryType === 'local' || !empty($cityValue))
                <input type="hidden" name="city" value="{{ $cityValue ?: $shopCity }}">
            @endif
            @error('city')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-6 col-md-6 mb-2">
            <label class="small fw-bold">Barangay</label>
            @php
                $barangayValue = $address->barangay ?? '';
            @endphp
            <select class="form-control" name="barangay" id="barangaySelect"
                @if(!empty($barangayValue)) disabled @endif
                data-value="{{ $barangayValue }}">
                <option value="">Select Barangay</option>
            </select>
            @if(!empty($barangayValue))
                <input type="hidden" name="barangay" value="{{ $barangayValue }}">
            @endif
            @error('barangay')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-6 col-md-6 mb-2">
            <label class="small fw-bold">Postal Code</label>
            @php
                $postalValue = $address->postal_code ?? '';
            @endphp
            <input type="text" class="form-control" name="postal_code" id="postalCode"
                placeholder="e.g. 1001" value="{{ $postalValue }}"
                @if(!empty($postalValue)) disabled @endif>
            @if(!empty($postalValue))
                <input type="hidden" name="postal_code" value="{{ $postalValue }}">
            @endif
            @error('postal_code')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
        <div class="col-12 col-md-6 mb-2">
            <label class="small fw-bold">Street</label>
            @php
                $streetValue = $address->street ?? '';
            @endphp
            <input type="text" class="form-control" name="street" id="street"
                placeholder="e.g. 123 Main St" value="{{ $streetValue }}"
                @if(!empty($streetValue)) disabled @endif>
            @if(!empty($streetValue))
                <input type="hidden" name="street" value="{{ $streetValue }}">
            @endif
            @error('street')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>
    </div>
</div>