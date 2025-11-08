<form action="{{ route('admin.product.variant.store', ['product_id' => $product->product_id]) }}" 
    method="POST" enctype="multipart/form-data">
    @csrf
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h5 class="m-0">Add Variant for: 
                <span class="fw-bold">{{ $product->product_name }}</span>
            </h5>
            <small>Category: <span class="text-primary">{{$product->category->name}}</span></small>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.product.show', ['id' => $product->product_id]) }}" 
                class="btn btn-outline-danger btn-sm">Discard</a>
            <button type="submit" class="btn btn-success btn-sm">Save Variant</button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label for="weight_kg" class="form-label fw-bold">Weight (kg)</label>
                    <input type="number" step="0.001" id="weight_kg" name="weight_kg"
                            value="{{ old('weight_kg') ?? $product->weight_kg }}"
                            class="form-control @error('weight_kg') is-invalid @enderror"
                            placeholder="e.g. 1.250">
                    @error('weight_kg')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6">
                    <label for="image" class="form-label fw-bold">Variant Image</label>
                    <input type="file" id="image" name="image" accept="image/*"
                            class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-6 mt-2">
                    <label for="material" class="form-label fw-bold">Material</label>
                    <select name="material" id="material" 
                            class="form-select @error('material') is-invalid @enderror">
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
                            $selectedMaterial = old('material') ?? $product->material ?? '';
                        @endphp
                        @foreach($materials as $mat)
                            <option value="{{ $mat }}" {{ $selectedMaterial == $mat ? 'selected' : '' }}>
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
                    <select name="color_finish" id="color_finish" 
                            class="form-select @error('color_finish') is-invalid @enderror">
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
                            $selectedColor = old('color_finish') ?? $product->color_finish ?? '';
                        @endphp
                        @foreach($colors as $col)
                            <option value="{{ $col }}" {{ $selectedColor == $col ? 'selected' : '' }}>
                                {{ $col }}
                            </option>
                        @endforeach
                    </select>
                    @error('color_finish')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div id="specific-specs" data-category="{{ $product->category->name }}"></div>
            <input type="hidden" id="old_specs" value='@json(old("specs") ?? $product->specs ?? "{}")'>
        </div>
        
        <div class="col-lg-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-white">
                    <p class="m-0 fw-bold text-secondary"><i class="fas fa-tags me-1"></i>Pricing</p>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="cost_price" class="form-label fw-bold">Cost Price</label>
                        <input type="number" step="0.01" id="cost_price" name="cost_price"
                                value="{{ old('cost_price') ?? $product->cost_price ?? 0 }}"
                                class="form-control @error('cost_price') is-invalid @enderror"
                                placeholder="₱ 0.00">
                        @error('cost_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="sale_price" class="form-label fw-bold">Sale Price</label>
                        <input type="number" step="0.01" id="sale_price" name="sale_price"
                                value="{{ old('sale_price') ?? $product->sale_price ?? 0 }}"
                                class="form-control @error('sale_price') is-invalid @enderror"
                                placeholder="₱ 0.00">
                        @error('sale_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <p class="m-0 fw-bold text-secondary"><i class="fas fa-boxes me-1"></i>Inventory</p>
                </div>
                <div class="card-body">
                    <label for="quantity" class="form-label fw-bold">Add Stock</label>
                    <input type="number" id="quantity" name="quantity"
                            value="{{ old('quantity') ?? 0 }}"
                            class="form-control @error('quantity') is-invalid @enderror" 
                            placeholder="Quantity">
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</form>
<script type="module" src="{{ asset('script/product-specs.js') }}"></script>