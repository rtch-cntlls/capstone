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
    @endphp
    @if($product->weight_kg || $product->material || $product->color_finish || $specs->isNotEmpty())
        <div class="m-3">
            <h6 class="fw-semibold text-dark mb-3">Product Specifications</h6>
            @php
                $allSpecs = collect([
                    'Weight' => $product->weight_kg ? number_format($product->weight_kg, 2) . ' kg' : null,
                    'Material' => $product->material,
                    'Color / Finish' => $product->color_finish,
                ])->merge($specs)->reject(fn($v) => empty($v));
            @endphp
            <div class="table-responsive d-none d-md-block">
                <table class="table table-bordered align-middle small mb-0">
                    <tbody>
                        @php
                            $rows = $allSpecs->chunk(3);
                        @endphp
                        @foreach($rows as $chunk)
                            <tr>
                                @foreach($chunk as $key => $value)
                                    <td class="text-muted fw-medium bg-light px-3 py-2 w-25">{{ ucwords(str_replace('_', ' ', $key)) }}</td>
                                    <td class="fw-semibold text-dark px-3 py-2">{{ $value }}</td>
                                @endforeach
                                @for($i = $chunk->count(); $i < 3; $i++)
                                    <td class="bg-light px-3 py-2"></td>
                                    <td class="px-3 py-2"></td>
                                @endfor
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-block d-md-none">
                <div class="row g-2">
                    @foreach($allSpecs as $key => $value)
                        <div class="col-12">
                            <div class="card shadow-sm border-0">
                                <div class="card-body d-flex justify-content-between align-items-center py-2 px-3">
                                    <span class="text-muted fw-medium">{{ ucwords(str_replace('_', ' ', $key)) }}</span>
                                    <span class="fw-semibold text-dark">{{ $value }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
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
                                <img src="{{ $rec['image'] ? asset('storage/' . $rec['image']) : asset('images/placeholder.png') }}"
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
    </script>
@endsection
