<div class="modal fade" id="editPricingModal" tabindex="-1" aria-labelledby="editPricingLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-primary text-white">
                <h6 class="modal-title fw-bold" id="editPricingLabel">
                    <i class="fa fa-pen me-2"></i>Edit Product
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.product.updatePricing', $product->product_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    <div class="row g-3 mb-3">
                        <div class="col-md-6">
                            <label for="cost_price" class="form-label fw-semibold">Cost Price</label>
                            <input type="number" name="cost_price" id="cost_price" step="0.01" min="0"
                                value="{{ old('cost_price', $product->cost_price) }}"
                                class="form-control form-control-lg @error('cost_price') is-invalid @enderror" required>
                            @error('cost_price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="sale_price" class="form-label fw-semibold">Sale Price</label>
                            <input type="number" name="sale_price" id="sale_price" step="0.01" min="0"
                                value="{{ old('sale_price', $product->sale_price) }}"
                                class="form-control form-control-lg @error('sale_price') is-invalid @enderror" required>
                            @error('sale_price')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-4">
                            <label for="weight_kg" class="form-label fw-semibold">Weight (kg)</label>
                            <input type="number" name="weight_kg" id="weight_kg" step="0.01" min="0"
                                value="{{ old('weight_kg', $product->weight_kg) }}"
                                class="form-control form-control-lg @error('weight_kg') is-invalid @enderror" required>
                            @error('weight_kg')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="material" class="form-label fw-semibold">Material</label>
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
                                    <option value="{{ $mat }}" {{ old('material', $product->material) == $mat ? 'selected' : '' }}>
                                        {{ $mat }}
                                    </option>
                                @endforeach
                            </select>
                            @error('material')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-4">
                            <label for="color_finish" class="form-label fw-semibold">Color / Finish</label>
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
                                    <option value="{{ $col }}" {{ old('color_finish', $product->color_finish) == $col ? 'selected' : '' }}>
                                        {{ $col }}
                                    </option>
                                @endforeach
                            </select>
                            @error('color_finish')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="compatible_models" class="form-label fw-semibold">Compatible Models</label>
                        <textarea name="compatible_models" id="compatible_models" rows="2"
                            class="form-control  @error('compatible_models') is-invalid @enderror">{{ old('compatible_models', $product->compatible_models) }}</textarea>
                        @error('compatible_models')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label fw-semibold">Product Image</label>
                        <input type="file" name="image" id="image" class="form-control form-control-lg @error('image') is-invalid @enderror" accept="image/*">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="Product Image" class="img-thumbnail mt-2 rounded-3" style="max-height: 120px;">
                        @endif
                    </div>
                </div>
                <div class="modal-footer border-0 px-4 pb-4">
                    <button type="button" class="btn btn-outline-secondary fw-semibold" data-bs-dismiss="modal">
                        Cancel
                    </button>
                    <button type="submit" class="btn btn-success fw-bold d-flex align-items-center">
                        <i class="fa fa-save me-2"></i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
