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
                <img src="{{  $product->image ? asset($product->image) : asset('images/placeholder.png') }}"
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
                    <span class="text-dark">{{ $description }}</span>
                    @if (!$fullDescription && strlen($product->description) > 100)
                        <a href="{{ request()->url() }}?fullDescription=1" class="text-primary">See more</a>
                    @elseif($fullDescription)
                        <a href="{{ request()->url() }}" class="text-primary">See less</a>
                    @endif
                </p>
                @if(!is_null($product->weight_kg))
                <p class="mb-0 text-muted small mt-2">
                    <span class="fw-bold">Weight:</span>
                    <span class="text-dark">{{ number_format($product->weight_kg, 3) }} kg</span>
                </p>
                @endif
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
                                <img src="{{ $rec['image'] ? asset($rec['image']) : asset('images/placeholder.png') }}"
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
@endsection
