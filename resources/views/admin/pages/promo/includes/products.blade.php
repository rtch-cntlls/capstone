{{-- <div class="row row-cols-2 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-3">
    @if ($products->isEmpty())
        <div class="w-100 text-center">
            <img src="{{ asset('images/empty.gif') }}" alt="No Products" style="width: 150px;">
            <p class="m-0 text-danger">No product found.</p>
        </div>
    @else
        @foreach ($products as $product)
            <div class="col">
                <div class="card h-100 shadow-sm selectable-card" data-product-id="{{ $product->product_id }}">
                    <div class="position-absolute top-0 start-0 m-2">
                        <input type="checkbox" 
                            name="product_ids[]" 
                            value="{{ $product->product_id }}" 
                            class="form-check-input product-checkbox" 
                            style="transform: scale(1.2);" 
                            {{ in_array($product->product_id, old('product_ids', [])) ? 'checked' : '' }}>
                    </div>
                    <img src="{{ $product->image ? asset($product->image) : asset('images/placeholder.png') }}"
                        class="card-img-top" style="height: 150px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h6 class="card-title mb-2" style="font-size: 12px;">{{ $product->product_name }}</h6>
                        <p class="card-text fw-bold text-success mt-auto mb-0">
                            ₱{{ number_format($product->sale_price, 2) }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</div>

<div class="mt-3">
    {{ $products->withQueryString()->links('pagination::bootstrap-5') }}
</div> --}}
