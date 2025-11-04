<form action="{{ route('admin.promo.store') }}" method="POST" class="create">
    @csrf
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Create Promo</h4>
        <div>
            <a href="{{ url()->previous() }}" class="btn btn-light border">Cancel</a>
            <button type="submit" class="btn btn-primary shadow-sm">
                <i class="fa fa-check me-1"></i> Apply Promo
            </button>
        </div>
    </div>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="bg-white border rounded shadow-sm p-3">
                <div class="mb-3">
                    <label class="form-label fw-semibold">Promo Type</label>
                    <select class="form-select" name="promo_type">
                        <option value="single">Single</option>
                        <option value="bundle">Bundle</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Promo Title</label>
                    <input type="text" name="title" value="{{ old('title') }}" 
                        class="form-control @error('title') is-invalid @enderror"
                        placeholder="e.g. Holiday Sale 2025">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Discount Percentage</label>
                    <input type="number" name="discount_percent" min="1" max="100"
                        value="{{ old('discount_percent') }}"
                        class="form-control @error('discount_percent') is-invalid @enderror"
                        placeholder="e.g. 20">
                    @error('discount_percent')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Promo Duration</label>
                    <input type="date" name="start_date" value="{{ old('start_date') }}" class="form-control mb-2">
                    <input type="date" name="expiry_date" value="{{ old('expiry_date') }}" class="form-control">
                </div>
            </div>
            <div class="text-end mt-3 d-md-none">
                <button type="button" 
                    class="btn btn-outline-primary w-100" 
                    data-bs-toggle="offcanvas" 
                    data-bs-target="#productDrawer" 
                    aria-controls="productDrawer">
                    <i class="fas fa-boxes me-2"></i> Select Products
                </button>
            </div>   
        </div>
        <div class="col-md-8 d-none d-md-block">
            <div class="bg-white border rounded shadow-sm p-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h5 class="fw-bold mb-0">Select Products</h5>
                </div>

                @error('product_ids')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div id="ajax-products">
                    @include('admin.pages.promo.includes.products', ['products' => $products])
                </div>
            </div>
        </div>
    </div>
</form>
<div class="offcanvas offcanvas-end" tabindex="-1" id="productDrawer" aria-labelledby="productDrawerLabel">
    <div class="offcanvas-header">
        <h5 id="productDrawerLabel" class="fw-bold mb-0">Select Products</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @include('admin.pages.promo.includes.products', ['products' => $products])
    </div>
</div>
