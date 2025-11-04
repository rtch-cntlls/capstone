{{-- <div class="offcanvas offcanvas-end shadow-lg" tabindex="-1" id="productDrawer"
     aria-labelledby="productDrawerLabel" style="width: 420px; max-width: 100%;">
    <div class="offcanvas-header border-bottom">
        <h5 class="offcanvas-title fw-bold" id="productDrawerLabel">
            <i class="fas fa-box me-2 text-primary"></i> Choose Products
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
    </div>
    <div class="offcanvas-body">
        <div class="row row-cols-2 g-3">
            @if ($products->isEmpty())
                <div class="w-100 text-center">
                    <img src="{{ asset('images/empty.gif') }}" alt="No Promo" style="width: 150px;">
                    <p class="m-0 text-danger form-text">No product found.</p>
                </div>
            @else
                @foreach ($products as $product)
                    <div class="col">
                        <div class="card h-100 shadow-sm selectable-card" data-product-id="{{ $product->product_id }}">
                            <div class="position-absolute top-0 start-0 m-2">
                                <input type="checkbox" name="product_ids[]" value="{{ $product->product_id }}"
                                    class="form-check-input product-checkbox" style="transform: scale(1.2);">
                            </div>
                            <img src="{{ $product->image ? asset($product->image) : asset('images/placeholder.png') }}"
                                class="card-img-top" style="height: 120px; object-fit: cover;">
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
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('form.create');
        const offcanvas = document.getElementById('productDrawer');
    
        form.addEventListener('submit', () => {
            form.querySelectorAll('input[name="product_ids[]"]').forEach(el => el.remove());
    
            const desktopChecked = document.querySelectorAll('#ajax-products .product-checkbox:checked');
            const mobileChecked = offcanvas.querySelectorAll('.product-checkbox:checked');
    
            const allChecked = [...desktopChecked, ...mobileChecked];
    
            allChecked.forEach(chk => {
                const clone = document.createElement('input');
                clone.type = 'hidden';
                clone.name = 'product_ids[]';
                clone.value = chk.value;
                form.appendChild(clone);
            });
        });
    });
</script>
    
     --}}