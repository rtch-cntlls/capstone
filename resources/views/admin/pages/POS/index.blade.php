@extends('admin.layouts.admin')
@section('content')
@include('components.ModalAlertSuccess')
@include('components.ModalAlertError')
<div class="p-2 mt-3">
    <div class="row">
        <div class="col-md-8">
            @include('admin.pages.pos.includes.filter')
            <div class="row g-3" style="max-height: 75vh; overflow-y: auto;">
                @if ($product->isEmpty())
                    <div class="text-center my-5">
                        <img src="{{ asset('storage/images/empty.gif') }}" alt="No Products" style="width: 200px;">
                        <p class="m-0">No products found</p>
                    </div>
                @else
                    @foreach ($product as $item)
                       <div class="col-6 col-sm-6 col-md-4 mb-3">
    						<div class="card h-100 shadow-sm">
                                <a href="{{ route('admin.product.show', $item->product_id) }}" class="text-decoration-none text-dark">
                                    <div class="d-flex align-items-center justify-content-center position-relative">
                                        <img src="{{ $item->image ? asset('storage/' . $item->image) : asset('storage/images/placeholder.png') }}" 
                                            alt="" style="height:200px; max-height:180%; max-width:100%; object-fit:contain;">
                                        <span class="badge bg-primary text-white position-absolute top-0 end-0 m-2">
                                            Stock: {{ $item->inventory->available_stock }}
                                        </span>
                                    </div>
                                </a>

                                <div class="card-body d-flex flex-column p-2">
                                    <p class="fw-bold mb-2" style="font-size:14px;">{{ $item->product_name }}</p>
                                    <div class="mt-auto">
                                        @php
                                            $validDiscount = $item->discounts
                                                ->where('status', 'Active')
                                                ->where('start_date', '<=', now()->toDateString())
                                                ->where('expiry_date', '>=', now()->toDateString())
                                                ->first();
                                        @endphp
                                        @if($validDiscount)
                                            @php
                                                $discountedPrice = $item->sale_price - ($item->sale_price * ($validDiscount->discount_percent / 100));
                                            @endphp
                                            <p class="text-muted mb-1">
                                                <span class="fw-bold text-success">₱ {{ number_format($discountedPrice, 2) }}</span>
                                                <small class="text-decoration-line-through text-secondary">
                                                    ₱ {{ number_format($item->sale_price, 2) }}
                                                </small>
                                            </p>
                                        @else
                                            <p class="text-muted mb-1">
                                                <span class="fw-bold text-success">₱ {{ number_format($item->sale_price, 2) }}</span>
                                            </p>
                                        @endif
                                        <form method="POST" action="{{ route('admin.pos.cart.add', $item->product_id) }}">
                                            @csrf
                                            @if($item->inventory->available_stock <= 0)
                                                <button type="submit" class="btn btn-sm btn-danger w-100" disabled>
                                                    Out of Stock
                                                </button>
                                            @else
                                                <button type="submit" class="btn btn-sm btn-outline-primary w-100">
                                                    Add
                                                </button>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="p-2">
                        {{ $product->links('pagination::bootstrap-5') }}  
                    </div>
                @endif
            </div>
        </div>
        @include('admin.pages.pos.includes.checkout')
    </div>
</div>
@endsection
