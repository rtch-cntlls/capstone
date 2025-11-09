@extends('client.layouts.clientNoFooter')
@section('content')
@include('components.ModalAlertSuccess')
@include('components.ModalAlertError')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('client.partials.accountnav')
        </div>
        <div class="col-md-9">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h4 class="fw-bold mb-0"><i class="fas fa-shopping-bag me-2 text-success"></i>My Orders</h4>
                @include('client.pages.myorder.includes.nav')
            </div>
            @if($orders->isEmpty())
                <div class="text-center py-5 bg-white border rounded shadow-sm">
                    <img src="{{ asset('storage/images/order.jpg') }}" alt="No orders" width="160" class="mb-3">
                    <h5 class="fw-semibold mb-2">No Orders Found</h5>
                    <p class="text-muted small mb-3">You don’t have any orders yet. Explore motorcycle parts products to get started.</p>
                    <a href="{{ route('shop.product') }}" class="btn btn-success">Order Parts Now</a>
                </div>
            @else
                <div class="d-none d-md-block">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Order #</th>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->order_number }}</td>
                                        <td>{{ \Carbon\Carbon::parse($order->placed_at)->format('M d, Y') }}</td>
                                        <td>₱{{ number_format($order->grand_total, 2) }}</td>
                                        <td>
                                            @php
                                                $badgeClass = match($order->status) {
                                                    'pending'           => 'bg-secondary',
                                                    'processing'        => 'bg-info text-white',
                                                    'out_for_delivery'  => 'bg-warning text-dark',
                                                    'ready_for_pick_up' => 'bg-primary text-white',
                                                    'completed'         => 'bg-success text-white',
                                                    'cancelled'         => 'bg-danger text-white',
                                                    default             => 'bg-dark text-white',
                                                };
                                            @endphp
                                            <span class="badge {{ $badgeClass }}">
                                                {{ ucfirst(str_replace('_',' ',$order->status)) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('order.show', $order->order_id) }}" class="btn btn-sm btn-primary me-1">View</a>
                                            @php
                                                $firstUnrated = null;
                                                if ($order->status === 'completed') {
                                                    $firstUnrated = $order->orderItems->first(function($i){
                                                        return empty($i->addrates);
                                                    });
                                                }
                                            @endphp
                                            @if($firstUnrated)
                                                <a href="{{ route('shop.details', $firstUnrated->product_id) }}?rate=1&order_item_id={{ $firstUnrated->id }}" class="btn btn-sm btn-warning text-dark">
                                                    <i class="fas fa-star me-1"></i> Add Ratings
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="mt-3">
                            {{ $orders->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
                <div class="d-md-none">
                    <div class="row g-3">
                        @foreach($orders as $order)
                            @php
                                $badgeClass = match($order->status) {
                                    'pending'           => 'bg-secondary',
                                    'processing'        => 'bg-info text-white',
                                    'out_for_delivery'  => 'bg-warning text-dark',
                                    'ready_for_pick_up' => 'bg-primary text-white',
                                    'completed'         => 'bg-success text-white',
                                    'cancelled'         => 'bg-danger text-white',
                                    default             => 'bg-dark text-white',
                                };
                            @endphp
                            <div class="col-12">
                                <div class="card shadow-sm h-100 hover-shadow">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <h6 class="mb-0">Order #{{ $order->order_number }}</h6>
                                            <span class="badge {{ $badgeClass }}">
                                                {{ ucfirst(str_replace('_',' ',$order->status)) }}
                                            </span>
                                        </div>
                                        <div class="mb-1 text-muted small">Date: {{ \Carbon\Carbon::parse($order->placed_at)->format('M d, Y') }}</div>
                                        <div class="mb-2">Total: ₱{{ number_format($order->grand_total, 2) }}</div>
                                        <a href="{{ route('order.show', $order->order_id) }}" class="btn btn-sm btn-outline-primary w-100 mb-2">View Details</a>
                                        @php
                                            $firstUnrated = null;
                                            if ($order->status === 'completed') {
                                                $firstUnrated = $order->orderItems->first(function($i){
                                                    return empty($i->addrates);
                                                });
                                            }
                                        @endphp
                                        @if($firstUnrated)
                                            <a href="{{ route('shop.details', $firstUnrated->product_id) }}?rate=1&order_item_id={{ $firstUnrated->id }}" class="btn btn-sm btn-outline-warning text-dark w-100">
                                                <i class="fas fa-star me-1"></i> Add Ratings
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-3">
                        {{ $orders->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
