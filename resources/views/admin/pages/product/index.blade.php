@extends('admin.layouts.admin')
@section('content')
@include('admin.pages.product.includes.cards')
<div class="card shadow-sm mx-2 mb-4 p-2">
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 mb-4">
                    <form method="GET" action="" data-auto-search>
                        <input type="search" name="search" value="{{ request('search') }}"
                               class="form-control form-control-sm search bg-light" 
                               placeholder="Search product name..." aria-label="Search">
                    </form>                            
            </div>
        </div>
        @if (session('success'))
            <x-alert type="success" :message="session('success')" />
        @endif
        @if ($products->isEmpty())
            <div class="text-center py-5">
                <img src="{{ asset('storage/images/empty.gif') }}" alt="No Products" style="width: 180px;">
                <p class="text-muted mt-3 mb-0">No products found</p>
            </div>
        @else
            <div class="table-responsive table-wrapper">
                <table class="table table-hover align-middle mb-0" style="font-size: 13px;">
                    <thead class="table-light text-secondary">
                        <tr>
                            <th></th>
                            <th>Product Name</th>
                            <th class="text-center">Condition</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Sale Price</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('storage/images/placeholder.png') }}" 
                                     width="40" class="rounded">
                            </td>                            
                            <td>
                                <a href="{{ route('admin.product.show', ['id' => $product->product_id]) }}" class="text-decoration-none">
                                    {{ $product->product_name }}
                                </a>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-success">{{ $product->condition ?? 'N/A' }}</span>
                            </td>
                            <td class="text-center">
                                @if ($product->status === 'Active')
                                    <span class="badge bg-primary">{{ $product->status }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $product->status }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                ₱{{ number_format($product->sale_price, 2) }}
                                @if($product->discounts->isNotEmpty())
                                    <span class="text-danger">({{ (int) $product->discount->first()->discount_percent }}% OFF)</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.product.show', ['id' => $product->product_id]) }}" 
                                        class="btn btn-outline-primary text-decoration-none">
                                        <i class="fas fa-eye"></i> View
                                    </a>
                                    <a href="#" class="btn {{ $product->status === 'Active' ? 'btn-outline-danger' : 'btn-outline-success' }}" 
                                       data-bs-toggle="modal" data-bs-target="#statusModal{{ $product->product_id }}">
                                       <i class="fas fa-pencil-alt"></i> {{ $product->status === 'Active' ? 'Deactivate' : 'Activate' }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @include('admin.pages.product.change-status')
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="p-2 mt-3 paginate">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
<script src="{{ asset('script/admin/search.js')}}"></script>
@endsection