<form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold m-0">Add Product</h4>
        <div class="d-flex gap-2">
            <a href="{{ url()->previous() }}" class="btn btn-outline-danger btn-sm">Discard</a>
            <button type="submit" class="btn btn-primary btn-sm">Publish Product</button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-8">
            <div class="mb-4">
                <label for="name" class="form-label fw-bold">Product Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                       class="form-control @error('name') is-invalid @enderror"
                       placeholder="Enter product name...">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="row g-3 mb-4">
                <div class="col-md-4">
                    <label for="weight_kg" class="form-label fw-bold">Weight (kg)</label>
                    <input type="number" step="0.001" id="weight_kg" name="weight_kg"
                           value="{{ old('weight_kg') }}" class="form-control @error('weight_kg') is-invalid @enderror"
                           placeholder="e.g. 1.250">
                    @error('weight_kg')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="material" class="form-label fw-bold">Material</label>
                    <select id="material" name="material" class="form-select @error('material') is-invalid @enderror">
                        <option value="">Select Material</option>
                        <option value="Steel" {{ old('material') == 'Steel' ? 'selected' : '' }}>Steel</option>
                        <option value="Aluminum" {{ old('material') == 'Aluminum' ? 'selected' : '' }}>Aluminum</option>
                        <option value="Plastic" {{ old('material') == 'Plastic' ? 'selected' : '' }}>Plastic</option>
                        <option value="Rubber" {{ old('material') == 'Rubber' ? 'selected' : '' }}>Rubber</option>
                        <option value="Carbon Fiber" {{ old('material') == 'Carbon Fiber' ? 'selected' : '' }}>Carbon Fiber</option>
                        <option value="Titanium" {{ old('material') == 'Titanium' ? 'selected' : '' }}>Titanium</option>
                        <option value="Copper" {{ old('material') == 'Copper' ? 'selected' : '' }}>Copper</option>
                        <option value="Brass" {{ old('material') == 'Brass' ? 'selected' : '' }}>Brass</option>
                        <option value="Leather" {{ old('material') == 'Leather' ? 'selected' : '' }}>Leather</option>
                        <option value="Glass" {{ old('material') == 'Glass' ? 'selected' : '' }}>Glass</option>
                        <option value="Other" {{ old('material') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('material')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4">
                    <label for="color_finish" class="form-label fw-bold">Color / Finish</label>
                    <select id="color_finish" name="color_finish" class="form-select @error('color_finish') is-invalid @enderror">
                        <option value="">Select Color / Finish</option>
                        <option value="Black" {{ old('color_finish') == 'Black' ? 'selected' : '' }}>Black</option>
                        <option value="Silver" {{ old('color_finish') == 'Silver' ? 'selected' : '' }}>Silver</option>
                        <option value="Chrome" {{ old('color_finish') == 'Chrome' ? 'selected' : '' }}>Chrome</option>
                        <option value="Red" {{ old('color_finish') == 'Red' ? 'selected' : '' }}>Red</option>
                        <option value="Blue" {{ old('color_finish') == 'Blue' ? 'selected' : '' }}>Blue</option>
                        <option value="Yellow" {{ old('color_finish') == 'Yellow' ? 'selected' : '' }}>Yellow</option>
                        <option value="Matte Black" {{ old('color_finish') == 'Matte Black' ? 'selected' : '' }}>Matte Black</option>
                        <option value="Other" {{ old('color_finish') == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                    @error('color_finish')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div id="specific-specs" class="mb-4"></div>
            <input type="hidden" id="product_specs" name="specs" value="">
            <div class="mb-4">
                <label for="description" class="form-label fw-bold">Product Description <small class="text-muted">(optional)</small></label>
                <textarea id="description" name="description" rows="6" style="resize:none"
                          class="form-control @error('description') is-invalid @enderror"
                          placeholder="Write a description...">{{ old('description') }}</textarea>
                @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-4">
                <label for="image" class="form-label fw-bold">Product Image</label>
                <input type="file" id="image" name="image" accept="image/*"
                       class="form-control @error('image') is-invalid @enderror">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card mb-4 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center bg-white">
                    <p class="m-0 fw-bold text-secondary"><i class="fas fa-box me-1"></i>Category</p>
                </div>
                <div class="card-body">
                    <label for="category_id" class="form-label fw-bold">Product Category</label>
                    <select name="category_id" id="category_id" class="form-select @error('category_id') is-invalid @enderror">
                        <option value="">Choose Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->category_id }}" {{ old('category_id') == $category->category_id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card mb-4 shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center bg-white">
                    <p class="m-0 fw-bold text-secondary"><i class="fas fa-tags me-1"></i>Pricing</p>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="cost_price" class="form-label fw-bold">Cost Price</label>
                        <input type="number" step="0.01" id="cost_price" name="cost_price"
                               value="{{ old('cost_price') }}" class="form-control @error('cost_price') is-invalid @enderror"
                               placeholder="₱ 0.00">
                        @error('cost_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="sale_price" class="form-label fw-bold">Sale Price</label>
                        <input type="number" step="0.01" id="sale_price" name="sale_price"
                               value="{{ old('sale_price') }}" class="form-control @error('sale_price') is-invalid @enderror"
                               placeholder="₱ 0.00">
                        @error('sale_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center bg-white">
                    <p class="m-0 fw-bold text-secondary"><i class="fas fa-boxes me-1"></i>Inventory</p>
                </div>
                <div class="card-body">
                    <label for="quantity" class="form-label fw-bold">Add Stock</label>
                    <input type="number" id="quantity" name="quantity" value="{{ old('quantity') }}"
                           class="form-control @error('quantity') is-invalid @enderror" placeholder="Quantity">
                    @error('quantity')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</form>
<script type="module" src="{{ asset('script/product-specs.js') }}"></script>
