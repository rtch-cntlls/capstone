@extends('admin.layouts.admin')
@section('content')
<div class="mt-2 mb-2">
    <a href="{{ url()->previous() }}" class="text-decoration-none small text-muted">
        <i class="fas fa-arrow-left me-1"></i> Back
    </a>
</div>
<div class="mb-2">
    <h4 class="fw-bold m-0">Customer Purchase History</h4>
</div>
<div class="mx-2 p-2">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <span>Customer Name: </span>
            <span class="fw-semibold">{{ $customer->user->firstname }} {{ $customer->user->lastname }}</span>
        </div>
        <div class="text-end">
            <p class="mb-1 fw-semibold">Address</p>
            <p class="mb-0 text-muted small">
                {{ $customer->addresses->first()->street }},
                {{ $customer->addresses->first()->barangay }},
                {{ $customer->addresses->first()->city }},
                {{ $customer->addresses->first()->province }}
            </p>
        </div>
    </div>
</div>
<div class="card mx-2 mb-4 p-4 shadow-sm">
    <div class="table-responsive table-wrapper">
        <table class="table table-hover align-middle" style="font-size: 14px;">
            <thead class="table-light">
                <tr>
                    <th class="text-center">Order #</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Payment</th>
                    <th class="text-center">Order Type</th>
                    <th class="text-center">Placed At</th>
                    <th class="text-center">Shipped At</th>
                    <th class="text-center">Completed Date</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($purchaseHistory as $order)
                    <tr>
                        <td class="text-center fw-semibold">#{{ $order->order_id }}</td>
                        <td class="text-center">
                            @if($order->status == 'completed')
                                <span class="badge bg-success">Completed</span>
                            @elseif($order->status == 'cancelled')
                                <span class="badge bg-danger">Cancelled</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($order->status) }}</span>
                            @endif
                        </td>
                        <td class="text-center">{{ $order->payment_method ?? 'N/A' }}</td>
                        <td class="text-center">{{ $order->delivery_type }}</td>
                        <td class="text-center">
                            <div>{{ $order->created_at->format('M d, Y') }}</div>
                            <div>{{ $order->created_at->format('h:i a') }}</div>
                        </td>
                        <td class="text-center">
                            @if($order->shipment && $order->shipment->shipped_at)
                                <div>{{ date('M d, Y', strtotime($order->shipment->shipped_at)) }}</div>
                                <div>{{ date('h:i a', strtotime($order->shipment->shipped_at)) }}</div>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($order->status == 'completed')
                                <div>{{ $order->updated_at->format('M d, Y') }}</div>
                                <div>{{ $order->updated_at->format('h:i a') }}</div>
                            @else
                                <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-outline-primary" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#orderItems{{ $order->order_id }}"
                                aria-expanded="false"
                                aria-controls="orderItems{{ $order->order_id }}">
                                View Items
                            </button>
                        </td>
                    </tr>
                    <tr class="collapse bg-light" id="orderItems{{ $order->order_id }}">
                        <td colspan="8">
                            <div class="p-3">
                                <h6 class="fw-bold">Order Items</h6>
                                <div class="table-responsive">
                                    <table class="table table-sm align-middle mb-0">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Product</th>
                                                <th class="text-center">Price</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-center">Subtotal</th>
                                                <th class="text-center">Discount/Promo</th>
                                                <th class="text-center">Delivery/Shippinng Fee</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($order->orderItems as $item)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center gap-2">
                                                            <img src="{{ $item->product->image ? asset('storage/' . $item->product->image) : asset('images/placeholder.png') }}"
                                                                alt="" width="45" height="45" class="rounded border" style="object-fit: cover;">
                                                            <span>{{ $item->product->product_name }}</span>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">₱{{ number_format($item->price, 2) }}</td>
                                                    <td class="text-center">{{ $item->quantity }}</td>
                                                    <td class="text-center fw-bold text-success">
                                                        ₱{{ number_format($order->subtotal, 2) }}
                                                    </td>
                                                    <td class="text-center fw-bold text-success">
                                                        ₱{{ number_format($item->discount, 2) }}
                                                    </td>
                                                    <td class="text-center fw-bold text-success">
                                                        ₱{{ number_format($item->delivery_fee, 2) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="text-end mt-2">
                                    <span class="fw-bold">Grand Total: </span>
                                    <span class="fw-bold text-success">₱{{ number_format($order->grand_total, 2) }}</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection