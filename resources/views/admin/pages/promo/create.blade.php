@extends('admin.layouts.admin')
@section('content')
<div class="p-3">
    <div class="mb-2">
        <a href="{{ url()->previous() }}" class="text-decoration-none small text-muted">
            <i class="fas fa-arrow-left me-1"></i> Back
        </a>
    </div>
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
                    <button type="button" class="btn btn-outline-primary w-100"
                        data-bs-toggle="offcanvas" data-bs-target="#productDrawer" aria-controls="productDrawer">
                        <i class="fas fa-boxes me-2"></i> Select Products
                    </button>
                </div>
            </div>

            {{-- DESKTOP PRODUCTS --}}
            <div class="col-md-8 d-none d-md-block">
                <div class="bg-white border rounded shadow-sm p-3">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h5 class="fw-bold mb-0">Select Products</h5>
                    </div>
                    @error('product_ids')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
                        @forelse ($products as $product)
                            <div class="col">
                                <div class="card h-100 shadow-sm selectable-card">
                                    <div class="position-absolute top-0 start-0 m-2">
                                        <input type="checkbox" name="product_ids[]" value="{{ $product->product_id }}"
                                            class="form-check-input product-checkbox"
                                            {{ in_array($product->product_id, old('product_ids', [])) ? 'checked' : '' }}>
                                    </div>
                                    <img src="{{ $product->image ? asset( $product->image) : asset('images/placeholder.png') }}"
                                        class="card-img-top" 
                                        style="height: 150px; object-fit: cover;">                               
                                    <div class="card-body d-flex flex-column">
                                        <h6 class="card-title mb-2" style="font-size: 12px;">{{ $product->product_name }}</h6>
                                        <p class="card-text fw-bold text-success mt-auto mb-0">
                                            ₱{{ number_format($product->sale_price, 2) }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="w-100 text-center">
                                <img src="{{ asset('images/empty.gif') }}" alt="No Products" style="width: 150px;">
                                <p class="m-0 text-danger">No product found.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-3">
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </form>

    {{-- MOBILE OFFCANVAS --}}
    <div class="offcanvas offcanvas-end shadow-lg" tabindex="-1" id="productDrawer"
        aria-labelledby="productDrawerLabel" style="width: 420px; max-width: 100%;">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title fw-bold">
                <i class="fas fa-box me-2 text-primary"></i> Choose Products
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            <div class="row row-cols-2 g-3">
                @forelse ($products as $product)
                    <div class="col">
                        <div class="card h-100 shadow-sm selectable-card">
                            <div class="position-absolute top-0 start-0 m-2">
                                <input type="checkbox" 
                                name="product_ids[]" 
                                value="{{ $product->product_id }}"
                                class="form-check-input product-checkbox"
                                data-product-id="{{ $product->product_id }}"
                                {{ in_array($product->product_id, old('product_ids', [])) ? 'checked' : '' }}>
                            
                            </div>
                            <img src="{{ $product->image ? asset( $product->image) : asset('images/placeholder.png') }}"
                                class="card-img-top" 
                                style="height: 120px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title mb-2" style="font-size: 12px;">{{ $product->product_name }}</h6>
                                <p class="card-text fw-bold text-success mt-auto mb-0">
                                    ₱{{ number_format($product->sale_price, 2) }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="w-100 text-center">
                        <img src="{{ asset('images/empty.gif') }}" alt="No Promo" style="width: 150px;">
                        <p class="m-0 text-danger form-text">No product found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('script/admin/promo.js')}}"></script>
@endsection
