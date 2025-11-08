<div class="col-md-6 mt-2">
    <label for="material" class="form-label fw-bold">Material</label>
    <select name="material" id="material" class="form-select @error('material') is-invalid @enderror">
        <option value="">Select Material</option>
        @php
            $materials = [
                'Steel', 'Stainless Steel', 'Aluminum', 'Billet Aluminum', 'Cast Iron',
                'Titanium', 'Carbon Steel', 'Alloy Steel', 'Chromoly', 'Brass', 'Copper', 'Zinc Alloy',
                'Plastic', 'ABS Plastic', 'Polycarbonate', 'Fiberglass', 'Carbon Fiber', 'Reinforced Polymer', 'Nylon',
                'Rubber', 'Silicone', 'Neoprene', 'Polyurethane (PU)', 'Foam', 'PVC',
                'Leather', 'Synthetic Leather', 'Vinyl', 'Acrylic', 'Glass',
                'Ceramic', 'Copper Wire', 'Composite Material', 'Heat-Resistant Material',
                'Mixed Materials', 'Other'
            ];
            sort($materials, SORT_STRING); 
        @endphp
        @foreach($materials as $mat)
            <option value="{{ $mat }}" {{ old('material') == $mat ? 'selected' : '' }}>
                {{ $mat }}
            </option>
        @endforeach
    </select>
    @error('material')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="col-md-6 mt-2">
    <label for="color_finish" class="form-label fw-bold">Color / Finish</label>
    <select name="color_finish" id="color_finish" class="form-select @error('color_finish') is-invalid @enderror">
        <option value="">Select Color / Finish</option>
        @php
            $colors = [
                'Black', 'Matte Black', 'Gloss Black',
                'Silver', 'Chrome', 'Gray', 'Gunmetal',
                'Gold', 'Rose Gold', 'Bronze', 'Titanium', 'Carbon Fiber', 'Anodized', 'Polished Aluminum',
                'Red', 'Matte Red', 'Blue', 'Matte Blue', 'Royal Blue',
                'Yellow', 'Neon Yellow', 'Green', 'Lime Green',
                'Orange', 'Purple', 'White',
                'Two-Tone', 'Brushed Metal', 'Matte Finish', 'Gloss Finish',
                'Iridescent', 'Rainbow', 'Oil Slick', 'Electroplated', 'Transparent',
                'Other'
            ];
            sort($colors, SORT_STRING);
        @endphp
        @foreach($colors as $col)
            <option value="{{ $col }}" {{ old('color_finish') == $col ? 'selected' : '' }}>
                {{ $col }}
            </option>
        @endforeach
    </select>
    @error('color_finish')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
