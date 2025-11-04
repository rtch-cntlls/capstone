@extends('client.layouts.clientNoFooter')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('client.partials.accountnav')
        </div>
        <div class="col-md-9">
            <h4 class="fw-bold mb-3 mt-3">
                <i class="fas fa-heart text-primary me-1"></i> My Wishlist
            </h4>
            @if($wishlist->isEmpty())
                <div class="text-center p-5 bg-white border rounded shadow-sm">
                    <img src="{{ asset('images/wishlist.jpg') }}" alt="wishlist" width="160">
                    <p class="text-muted small mb-3">
                        No products found in your wishlist. <br>
                        Explore motorcycle parts product to get started.
                    </p>
                    <a href="{{ route('shop.product') }}" class="btn btn-primary">
                        <i class="fas fa-shopping-bag me-1"></i> Continue Shopping
                    </a>
                </div>
            @else
                <div class="row g-3">
                    @foreach($wishlist as $item)
                        <div class="col-12 col-md-6">
                            <div class="d-flex p-3 border rounded shadow-sm h-100">
                                <div style="flex-shrink:0; width:100px; height:100px;" class="d-flex align-items-center justify-content-center">
                                    <img src="{{ $item['image'] ? asset($item['image']) : asset('images/placeholder.png') }}" 
                                         alt="{{ $item['product_name'] }}" 
                                         class="img-fluid" style="max-height:100%; object-fit:contain;">
                                </div>
                                <div class="flex-grow-1 ms-3 d-flex flex-column justify-content-between">
                                    <div>
                                        <h6 class="fw-bold mb-1">{{ $item['product_name'] }}</h6>
                                        <div class="text-muted small">{{ $item['category'] }}</div>
                                    </div>
        
                                    <div class="d-flex justify-content-between align-items-center mt-2">
                                        @if($item['discount_percentage'] > 0)
                                            <div>
                                                <span class="fw-bold fs-6 text-danger">₱{{ $item['sale_price'] }}</span><br>
                                                <span class="text-muted text-decoration-line-through small">₱{{ $item['original_price'] }}</span>
                                            </div>
                                        @else
                                            <h6 class="fw-bold mb-0">₱{{ $item['sale_price'] }}</h6>
                                        @endif
                                        <div class="d-flex">
                                            <form action="{{ route('wishlist.remove') }}" method="POST" class="me-2">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                                <button type="submit" class="btn btn-link text-danger p-0">
                                                    <i class="fas fa-trash-alt fa-lg"></i>
                                                </button>
                                            </form>
        
                                            <form action="{{ route('cart.add') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item['product_id'] }}">
                                                <input type="hidden" name="quantity" value="1">
                                                <button type="submit" class="btn btn-link text-success p-0">
                                                    <i class="fas fa-shopping-cart fa-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
