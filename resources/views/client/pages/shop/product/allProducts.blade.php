<script>
    function getSelectedCategories() {
        return Array.from(document.querySelectorAll('input[name="categories[]"]:checked'))
                    .map(cb => cb.value);
    }
    
    function loadProducts() {
        const isNew = document.getElementById('filterNew').checked ? 1 : 0;
        const isSale = document.getElementById('filterSale').checked ? 1 : 0;
        const categories = getSelectedCategories();
    
        $('#product-loader').show();
        $('#product-list').hide();
    
        $.get('/shop/api/products/filter', {
            new: isNew,
            sale: isSale,
            'categories[]': categories
        }, function(products) {
            let html = '';
    
            if (products.length === 0) {
                html = `
                    <div class="text-muted text-center bg-white p-4 shadow-sm border">
                        <img src="{{asset('images/empty.gif')}}" alt="Image" width="250">
                        <p class="mt-2 form-text">No products found</p>
                    </div>
                `;
                $('#product-list').html(html).show();
                $('#product-loader').hide();
                return;
            }
    
            products.forEach(product => {
                const conditionBadge = product.condition === 'New'
                    ? '<span class="badge bg-success position-absolute top-0 start-0 m-2">New</span>'
                    : '';
                const hasDiscount = product.discount_percentage > 0;
                const priceHTML = hasDiscount
                    ? `<div class="px-2 m-0 d-flex justify-content-between align-items-center flex-wrap">
                            <span class="text-muted text-decoration-line-through" style="font-size: 13px;">
                                ₱${product.original_price}
                            </span>
                            <span class="fw-bold fs-5">₱${product.sale_price}</span>
                        </div>
                        <div>
                            <p class="text-center m-0 fw-bold expiry small">Promo ends in 
                                <span class="text-success">${product.expiry_date}</span>
                            </p>    
                        </div>`
                    : `<div class="px-2">
                            <h5 class="card-text fw-bold m-0">₱${product.sale_price}</h5>
                        </div>`;
    
                html += `
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-4">
                        <a href="/shop/product/${product.product_id}" class="text-decoration-none text-dark">
                            <div class="card h-100 d-flex flex-column position-relative p-2">
                                <span class="position-absolute top-0 end-0 m-2" onclick="event.stopPropagation();">
                                    <form action="{{ route('wishlist.add') }}" method="POST"> @csrf
                                        <input type="hidden" name="product_id" value="${product.product_id}">
                                        <button type="submit" class="btn btn-outline-primary rounded-circle p-2">
                                            <i class="far fa-heart"></i>
                                        </button>
                                    </form>
                                </span>
                                <img src="${product.image ? '/storage/' + product.image : 'storage/images/placeholder.png'}"
                                    class="card-img-top product-img img-fluid"
                                    style="object-fit: cover; max-height: 200px;"
                                    onerror="this.src='/images/placeholder.png'">
                                ${conditionBadge}
                                <div class="card-body d-flex flex-column justify-content-between px-2 py-1">
                                    <h6 class="card-title product-name text-truncate">${product.product_name}</h6>
                                    ${priceHTML}
                                </div>
                            </div>
                        </a>
                    </div>
                `;
            });
    
            $('#product-loader').hide();
            $('#product-list').html(html).show();
        });
    }
    
    $(document).ready(function () {
        loadProducts(); 
    
        $('input[type="checkbox"]').on('change', function () {
            loadProducts();
        });
    });
</script>
    