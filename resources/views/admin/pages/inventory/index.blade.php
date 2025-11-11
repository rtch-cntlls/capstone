@extends('admin.layouts.admin')
@section('content')
@include('components.ModalAlertSuccess')
@include('components.ModalAlertError')
@include('components.adminloader')
@include('admin.pages.inventory.includes.cards')
<div class="card mx-2 mb-4 p-4 shadow-sm">
    <div class="inventory" style="font-size: 13px;">
        <div class="row">
            <div class="col-md-6 mb-4">
                <form method="GET" action="" data-auto-search>
                    <input type="search" name="search" value="{{ request('search') }}"
                           class="form-control inv-search search bg-light" 
                           placeholder="Search product name or category" aria-label="Search">
                </form>                           
            </div>
        </div>
        @if ($products->isEmpty())
            <div class="text-center my-5">
                <img src="{{ asset('images/empty.gif') }}" alt="No Products" style="width: 200px;">
                <p class="mt-3 text-muted">No products found</p>
            </div>
        @else
            <div class="table-responsive table-wrapper">
                <table class="table table-hover align-middle text-sm mb-0 w-auto">
                    <thead class="table-light">
                        <tr>
                            <th>Inventory ID</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>In-Stock</th>
                            <th class="text-center">Status</th>
                            <th>Date Added</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->inventory->code ?? 'N/A' }}</td>
                                <td>
                                    @if ($product->inventory)
                                        <a href="{{ route('admin.inventory.show', ['id' => $product->inventory->inventory_id]) }}"
                                        class="text-decoration-none fw-medium">
                                            {{ $product->product_name }}
                                        </a>
                                    @else
                                        {{ $product->product_name }}
                                    @endif
                                </td>
                                <td>{{ $product->category->name ?? 'N/A' }}</td>
                                <td>{{ $product->inventory->available_stock ?? 'N/A' }}</td>
                                <td class="text-center">
                                    @php
                                        $status = $product->inventory->stock_status ?? 'out_of_stock';
                                        $badgeClass = match($status) {
                                            'in_stock' => 'bg-success',
                                            'low_stock' => 'bg-warning text-dark',
                                            default => 'bg-danger',
                                        };
                                        $statusText = match($status) {
                                            'in_stock' => 'In Stock',
                                            'low_stock' => 'Low Stock',
                                            default => 'Out of Stock',
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ $statusText }}</span>
                                </td>
                                <td class="text-muted">{{ $product->created_at->format('M-d-Y') }}</td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('admin.inventory.show', ['id' => $product->inventory->inventory_id ?? 0]) }}" 
                                        class="btn btn-outline-primary" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" 
                                                class="btn btn-outline-secondary"
                                                title="Update Status"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#actionModal{{ $product->product_id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                    </div>
                                </td>
                                @include('admin.pages.inventory.edit')
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>        
        @endif
    </div>
    <div class="p-2 mt-3 paginate">
        {{ $products->links('pagination::bootstrap-5') }}  
    </div>
</div>
<script src="{{ asset('script/admin/search.js')}}"></script>
@endsection
