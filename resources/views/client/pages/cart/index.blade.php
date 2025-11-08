@extends('client.layouts.clientNoFooter')
@section('content')
@include('components.toastAlert')
<div class="container my-3">
    <a class="text-decoration-none d-inline-block mb-3" href="{{ route('shop.product') }}">
        <i class="fas fa-arrow-left me-1"></i> Continue Shopping
    </a>
    <div class="row g-3">
        <div class="col-12 col-md-8">
            <div class="p-3 bg-white border shadow-sm"
                 style="height: calc(100vh - 180px); overflow-y: auto;">
                <h3 class="fw-bold text-success mb-3 d-md-block d-none">Shopping Cart</h3>

                @if($cartItems->isEmpty())
                    <div class="text-center py-5">
                        <img src="{{ asset('images/cart.gif')}}" alt="cart" width="200">
                        <p class="text-muted m-0">Your cart is empty.</p>
                    </div>
                @else
                    <div class="table-responsive d-none d-md-block">
                        <table class="table align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 40px;"></th>
                                    <th>Product</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-end">Price</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                <tr>
                                    <td class="text-center">
                                        <form action="{{ route('cart.toggleSelection') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                            <input type="hidden" name="selected" value="{{ $item->selected ? 1 : 0 }}">
                                            <input type="checkbox" name="selected" value="1"
                                                {{ $item->selected ? 'checked' : '' }}
                                                onchange="this.previousElementSibling.value = this.checked ? 1 : 0; this.form.submit()">
                                        </form>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : asset('images/placeholder.png') }}"
                                                alt="{{ $item->product->product_name }}"
                                                class="me-2 rounded border"
                                                style="width:50px;height:50px;object-fit:cover;">                                       
                                            <span class="fw-semibold small text-truncate" style="max-width:180px;" title="{{ $item->product->product_name }}">
                                                {{ $item->product->product_name }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="text-center">{{ $item->quantity }}</td>
                                    <td class="text-end fw-bold text-danger">₱{{ number_format($item->discounted_price * $item->quantity,2) }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('cart.delete') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                            <button type="submit" class="btn btn-sm btn-light text-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="d-md-none">
                        <div class="row g-3">
                            @foreach ($cartItems as $item)
                            <div class="col-12">
                                <form id="mobile-form-{{$item->product_id}}" action="{{ route('cart.toggleSelection') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                    <input type="hidden" name="selected" value="{{ $item->selected ? 1 : 0 }}">
                                </form>
                                <div class="card p-2 shadow-sm">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <div class="d-flex align-items-center">
                                            <input type="checkbox" class="me-2"
                                                {{ $item->selected ? 'checked' : '' }}
                                                onchange="document.querySelector('#mobile-form-{{$item->product_id}} input[name=selected]').value = this.checked ? 1 : 0; document.getElementById('mobile-form-{{$item->product_id}}').submit();">
                                            <img src="{{ $item->product->image ? asset($item->product->image) : asset('images/placeholder.png') }}"
                                                alt="{{ $item->product->product_name }}" class="rounded border me-2" style="width:50px;height:50px;object-fit:cover;">
                                            <span class="fw-semibold small text-truncate" style="max-width:120px;" title="{{ $item->product->product_name }}">
                                                {{ $item->product->product_name }}
                                            </span>
                                        </div>
                                        <form action="{{ route('cart.delete') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                            <button type="submit" class="btn btn-sm btn-light text-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                    <div class="d-flex justify-content-between small text-muted">
                                        <div>Qty: {{ $item->quantity }}</div>
                                        <div>Price: ₱{{ number_format($item->discounted_price * $item->quantity,2) }}</div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="col-md-4 d-none d-md-flex flex-column">
            @include('client.pages.cart.includes.summary')
       </div>
    </div>
</div>
@if($selectedItems->count() > 0)
    <div class="d-md-none fixed-bottom bg-white border-top shadow-sm p-4">
        <div class="d-flex justify-content-between align-items-center">
            <div class="fw-semibold small">Total: ₱{{ number_format($selectedItems->sum('total_price'),2) }}</div>
            <form action="{{ route('cart.checkoutSelected') }}" method="POST" class="m-0">
                @csrf
                <button type="submit" class="btn btn-success btn-sm px-3">Checkout</button>
            </form>
        </div>
    </div>
@endif
@endsection
