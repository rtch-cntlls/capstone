@extends('client.layouts.clientNoFooter')
@section('content')
@include('components.ModalAlertSuccess')
@include('components.ModalAlertError')
<div class="container my-3">
    <a class="text-decoration-none d-inline-block mb-3" href="{{ route('shop.product') }}">
        <i class="fas fa-arrow-left me-1"></i> Continue Shopping
    </a>
    <div class="row g-4">
        <div class="col-12 col-md-5">
            <div class="card p-3 shadow-sm">
                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('storage/images/placeholder.png') }}"
                class="w-100 product-detail-img rounded"
                alt="">
                <div class="mt-3">
                    <a href="#ratingsSection" class="btn btn-outline-secondary w-100" id="viewCommentsBtn">
                        <i class="fas fa-comments me-1"></i> View comments
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-7">
            <div class="d-flex justify-content-between">
                <h6 class="text-primary mt-2">
                    <i class="fas fa-tag me-2"></i>{{ $product->category->name }}
                </h6>
                <h6 class="text-danger mt-2 fw-bold">Available Stock:
                    {{ $product->inventory->available_stock }}
                </h6>
            </div>
            <h4 class="fw-bold">{{ $product->product_name }}</h4>
            <div class="my-2">
                <span class="fs-2 me-3 text-danger fw-bold">
                    ₱{{ number_format($discountedPrice, 2) }}
                </span>
                @if ($discountPercentage > 0)
                    <span class="fs-5 me-3 text-muted text-decoration-line-through">
                        ₱{{ number_format($originalPrice, 2) }}
                    </span>
                    <span class="fs-4 text-danger fw-bold">{{ $discountPercentage }}% OFF</span>
                    <p class="text-success small">Promo ends on: {{ $promoDate }}</p>
                @endif
            </div>
            <div class="mb-3">
                <p class="mb-0 text-muted small">
                    <span class="fw-bold">Description:</span>
                    <span class="text-dark" id="productDescription">
                        {{ Str::limit($product->description, 100) }}
                    </span>
                    @if (strlen($product->description) > 100)
                        <a href="javascript:void(0)" class="text-primary" id="toggleDescription">See more</a>
                    @endif
                </p>
            </div>          
            @if ($shop->enable_direct_buy)
                <div class="mt-3">
                    <label class="form-label fw-bold text-muted">Quantity</label>
                    <div class="input-group" style="max-width:200px;">
                        <button type="button" class="btn btn-outline-secondary" id="decrease">-</button>
                        <input type="number" name="quantity" id="quantity" value="1" min="1" 
                            class="form-control text-center border border-secondary" 
                            readonly
                            data-stock="{{ $product->inventory->available_stock }}">
                        <button type="button" class="btn btn-outline-secondary" id="increase">+</button>
                    </div>
                </div>
                <div class="mt-3 d-flex flex-column flex-md-row gap-2">
                    @if ($product->inventory->stock_status === 'out_of_stock')
                        <div class="btn btn-outline-danger w-100 btn-lg fw-bold">Item out of stock</div>
                    @else
                        <form action="{{ route('cart.add') }}" method="POST" class="flex-fill">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                            <input type="hidden" name="price" value="{{ $discountedPrice }}">
                            <input type="hidden" name="quantity" id="quantity_cart">
                            <button class="btn btn-success btn-lg w-100">
                                <i class="fas fa-shopping-cart me-2"></i>Add to Cart
                            </button>
                        </form>
                        <form action="{{ route('checkout.buyNow') }}" method="POST" class="flex-fill">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->product_id }}">
                            <input type="hidden" name="product_name" value="{{ $product->product_name }}">
                            <input type="hidden" name="image" value="{{ $product->image ? asset($product->image) : asset('images/placeholder.png') }}">
                            <input type="hidden" name="price" value="{{ $discountedPrice }}">
                            <input type="hidden" name="discount" value="{{ $discountAmount }}">
                            <input type="hidden" name="quantity" id="quantity_buy">
                            <button type="submit" class="btn btn-outline-danger btn-lg w-100">
                                <i class="fas fa-shopping-bag me-2"></i>Buy Now
                            </button>
                        </form>
                    @endif
                </div>
            @endif
        </div>
    </div>
    @php
        $specs = collect(json_decode($product->specs, true) ?? [])
            ->reject(fn($value) => $value === '-' || $value === null || trim($value) === '');

        $allSpecs = collect([
            'Weight' => $product->weight_kg ? number_format($product->weight_kg, 2) . ' kg' : null,
            'Material' => $product->material,
            'Color / Finish' => $product->color_finish,
        ])->merge($specs)->reject(fn($v) => empty($v));
    @endphp

    @if($allSpecs->isNotEmpty())
        <div class="my-4">
            <h5 class="fw-bold text-dark mb-3">
                <i class="fas fa-info-circle me-2 text-primary"></i>Product Specifications
            </h5>

            <div class="d-none d-md-grid" style="grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 1rem;">
                @foreach($allSpecs as $key => $value)
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body text-center p-3">
                            <div class="text-muted small mb-1">{{ ucwords(str_replace('_', ' ', $key)) }}</div>
                            <div class="fw-semibold">{{ $value }}</div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="d-md-none">
                <div class="row g-2">
                    @foreach($allSpecs as $key => $value)
                        <div class="col-6">
                            <div class="card shadow-sm border-0">
                                <div class="card-body text-center py-2">
                                    <div class="text-muted small mb-1">{{ ucwords(str_replace('_', ' ', $key)) }}</div>
                                    <div class="fw-semibold">{{ $value }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <div class="mt-3" id="ratingsSection">
        <h5 class="fw-bold mb-4">
            <i class="fas fa-star text-warning me-2"></i> Product Ratings
        </h5>
        <div id="reviewAlert" class="alert alert-success d-none mt-2"></div>
        <div class="row g-3">
            <div class="col-12 col-md-4">
                <div class="card shadow-sm border-0 h-100 text-center p-3">
                    <div class="display-4 fw-bold text-warning">{{ $averageRating ?: '0.0' }}</div>
                    <div class="text-muted mb-2">out of 5</div>
                    <div class="progress rounded-pill" style="height: 10px;">
                        <div class="progress-bar bg-warning" role="progressbar"
                             style="width: {{ ($averageRating/5)*100 }}%;"
                             aria-valuenow="{{ $averageRating }}" aria-valuemin="0" aria-valuemax="5">
                        </div>
                    </div>
                    <small class="text-muted mt-2 d-block">{{ $totalReviews }} Rating/Reviews</small>
                </div>
            </div>
            <div class="col-12 col-md-8">
                <div class="card shadow-sm border-0 p-3">
                    <div class="d-flex flex-wrap gap-2 mb-3">
                        <button class="btn btn-sm btn-outline-secondary filter-btn" data-stars="">All</button>
                        @for($i=5;$i>=1;$i--)
                            <button class="btn btn-sm btn-outline-secondary filter-btn" data-stars="{{ $i }}">
                                {{ $i }} Star ({{ $starCounts[$i] ?? 0 }})
                            </button>
                        @endfor
                        <button class="btn btn-sm btn-outline-secondary" id="btnWithComments">
                            With Comments ({{ $withCommentsCount }})
                        </button>
                    </div>
                    <div id="reviewsList" class="vstack gap-3 mt-2"></div>
                    @php $oiq = request('order_item_id'); @endphp
                    @if(($canRate && $rateableOrderItemId) || $oiq)
                        <div class="mt-3">
                            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#reviewModal">
                                <i class="fas fa-star me-1"></i> Add Your Rating
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    
        @if(($canRate && $rateableOrderItemId) || $oiq)
            <div class="modal fade" id="reviewModal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content rounded-4 shadow-lg">
                        <div class="modal-header border-bottom-0">
                            <h5 class="modal-title fw-bold">Rate This Product</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="reviewForm">
                                <input type="hidden" name="order_item_id" value="{{ $oiq ?: $rateableOrderItemId }}">
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Rating</label>
                                    <div class="d-flex gap-2" id="starPicker">
                                        @for($i=1;$i<=5;$i++)
                                            <button type="button" class="btn btn-outline-warning star rounded-circle p-2" data-value="{{ $i }}">
                                                <i class="fas fa-star"></i>
                                            </button>
                                        @endfor
                                    </div>
                                    <input type="hidden" name="rating" id="ratingValue" value="5">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Comment (optional)</label>
                                    <textarea class="form-control" name="comment" rows="3" placeholder="Share your experience..."></textarea>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer border-top-0">
                            @csrf
                            <button class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button class="btn btn-primary" id="submitReviewBtn">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

     @if ($recommendedProducts->count())
        <div class="mt-5">
            <h5 class="fw-bold mb-3">
                <i class="fas fa-lightbulb me-2 text-warning"></i>Recommended for You
            </h5>
            <div class="row g-3">
                @foreach ($recommendedProducts as $rec)
                    <div class="col-6 col-md-4">
                        <div class="card h-100 shadow-sm border-0">
                            <a href="{{ route('shop.details', $rec['product_id']) }}" class="text-decoration-none text-dark">
                                <img src="{{ $rec['image'] ? asset('storage/' . $rec['image']) : asset('storage/images/placeholder.png') }}"
                                    alt="{{ $rec['product_name'] }}" 
                                    class="card-img-top rounded-top" 
                                    style="height:180px; object-fit:cover;">                           
                                <div class="card-body text-center">
                                    <h6 class="fw-bold">{{ Str::limit($rec['product_name'], 40) }}</h6>
                                    <div class="mt-1">
                                        <span class="text-danger fw-bold">₱{{ $rec['sale_price'] }}</span>
                                        @if ($rec['discount_percentage'] > 0)
                                            <small class="text-muted text-decoration-line-through d-block">
                                                ₱{{ $rec['original_price'] }}
                                            </small>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

</div>
<script src="{{asset('script/customer/quantity.js')}}"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const descEl = document.getElementById('productDescription');
        const toggleEl = document.getElementById('toggleDescription');
    
        if (!descEl || !toggleEl) return;
    
        const fullText = `{{ addslashes($product->description) }}`;
        const shortText = fullText.length > 100 ? fullText.substring(0, 100) + '...' : fullText;
    
        let isFull = false;
    
        toggleEl.addEventListener('click', function () {
            if (isFull) {
                descEl.textContent = shortText;
                toggleEl.textContent = 'See more';
            } else {
                descEl.textContent = fullText;
                toggleEl.textContent = 'See less';
            }
            isFull = !isFull;
        });
    });
    const reviewsApi = `{{ route('shop.reviews.index', $product->product_id) }}`;
    const reviewsList = document.getElementById('reviewsList');
    const filterButtons = document.querySelectorAll('.filter-btn');
    let withComments = false;
    let activeStars = '';
    let showAllReviews = false;

    function renderReviews(data){
    reviewsList.innerHTML = '';
    const items = data.reviews.data || [];
    if(items.length === 0){
        reviewsList.innerHTML = '<div class="text-muted">No reviews yet.</div>';
        return;
    }

    const displayedItems = showAllReviews ? items : items.slice(0, 1);

    displayedItems.forEach(r => {
    const name = r.customer?.user 
            ? `${r.customer.user.firstname ? r.customer.user.firstname[0] + '*****' : ''} \
    ${r.customer.user.lastname ? r.customer.user.lastname[0] + '*****' : ''}`.trim()
                : 'Customer';

            function renderStars(rating) {
                let html = '';
                for (let i = 1; i <= 5; i++) {
                    html += i <= rating 
                        ? '<i class="fas fa-star text-warning"></i> ' 
                        : '<i class="far fa-star text-muted"></i> ';
                }
                return html;
            }

            const stars = renderStars(r.rating);
            const imgs = (r.images || []).map(u => 
                `<img src="${u.startsWith('http') ? u : ('<?= asset('storage/') ?>'+'/'+u) }" class="rounded me-2 mb-2" style="width:70px;height:70px;object-fit:cover;">`
            ).join('');
            const replies = (r.replies || []).map(rep => 
                `<div class="ms-3 mt-2 p-2 bg-light rounded small"><strong>Admin:</strong> ${rep.comment}</div>`
            ).join('');

            const card = document.createElement('div');
            card.className = 'card border-0 shadow-sm';
            card.innerHTML = `<div class="card-body">
                <div class="d-flex align-items-center gap-2">
                    <img src="{{ asset("storage/profile/customer.webp") }}" class="rounded-circle" style="width:40px; height:40px; object-fit:cover;">
                    <div class="fw-semibold">${name}</div>
                    <div class="text-warning ms-auto">${stars}</div>
                </div>
                ${r.comment ? `<div class="mx-3">${r.comment}</div>` : ''}
                ${imgs ? `<div class="mt-2">${imgs}</div>` : ''}
                ${replies}
            </div>`;
            reviewsList.appendChild(card);
        });

        if(items.length > 1){
            const toggleBtn = document.createElement('button');
            toggleBtn.className = 'btn btn-link p-0 mt-2';
            toggleBtn.textContent = showAllReviews ? 'Show Less' : `Show All (${items.length})`;
            toggleBtn.addEventListener('click', ()=>{
                showAllReviews = !showAllReviews;
                renderReviews(data);
            });
            reviewsList.appendChild(toggleBtn);
        }
    }

    async function loadReviews(){
        const params = new URLSearchParams();
        if(activeStars) params.append('stars', activeStars);
        if(withComments) params.append('with_comments', '1');
        
        const res = await fetch(`${reviewsApi}?${params.toString()}`);
        const json = await res.json();
        renderReviews(json);
    }

    filterButtons.forEach(btn=>{
        btn.addEventListener('click', ()=>{
            activeStars = btn.dataset.stars;
            loadReviews();
        });
    });
    const btnWithComments = document.getElementById('btnWithComments');
    if(btnWithComments){ btnWithComments.addEventListener('click', ()=>{ withComments = !withComments; btnWithComments.classList.toggle('btn-secondary'); loadReviews(); }); }

    loadReviews();

    const starPicker = document.getElementById('starPicker');
    const ratingValue = document.getElementById('ratingValue');
    if(starPicker){
        starPicker.querySelectorAll('.star').forEach(btn=>{
            btn.addEventListener('click', ()=>{
                ratingValue.value = btn.dataset.value;
                starPicker.querySelectorAll('.star').forEach(b=>b.classList.remove('btn-warning'));
                btn.classList.add('btn-warning');
            });
        });
    }

    const submitBtn = document.getElementById('submitReviewBtn');
    if(submitBtn){
        submitBtn.addEventListener('click', async ()=>{
            const form = document.getElementById('reviewForm');
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const payload = {
                order_item_id: form.order_item_id.value,
                rating: form.rating.value,
                comment: form.comment.value
            };
            const res = await fetch(`{{ route('shop.reviews.store') }}`,{
                method:'POST',
                headers: { 'Content-Type':'application/json', 'X-CSRF-TOKEN': token },
                body: JSON.stringify(payload)
            });
            if(res.ok){
                loadReviews();
                const modalEl = document.getElementById('reviewModal');
                const modal = bootstrap.Modal.getInstance(modalEl);
                modal?.hide();
                const alertBox = document.getElementById('reviewAlert');
                if (alertBox) { alertBox.classList.remove('d-none'); alertBox.textContent = 'Commented successfully.'; }
            } else {
                alert('Failed to submit review');
            }
        });
    }

    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('rate') === '1') {
        const modalEl = document.getElementById('reviewModal');
        if (modalEl) {
            const m = new bootstrap.Modal(modalEl);
            m.show();
        }
    }
    </script>
@endsection
