@extends('client.layouts.clientNoFooter')
@section('content')
@include('components.ModalAlertSuccess')
@include('components.ModalAlertError')
<div class="container">
    <div class="mb-3">
        <a href="{{ route('order.index') }}" class="text-decoration-none small text-muted">
            <i class="fas fa-arrow-left me-1"></i> Back to Orders
        </a>
    </div>
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <div class="d-flex flex-column flex-md-row justify-content-between gap-4">
                <div>
                    <h4 class="fw-bold mb-3 text-primary">
                        <i class="fas fa-box me-2"></i> Order #{{ $order->order_number }}
                    </h4>
                    <p class="mb-1"><span class="fw-semibold text-dark">Customer:</span> {{ $order->customer->user->firstname }} {{ $order->customer->user->lastname }}</p>
                    <p class="mb-1"><span class="fw-semibold text-dark">Email:</span> {{ $order->customer->user->email }}</p>
                    <p class="mb-1"><span class="fw-semibold text-dark">Phone number:</span> {{ $order->customer->phone }}</p>
                    <p class="mb-1"><span class="fw-semibold text-dark">Placed At:</span> {{ date('M. d, Y - h:i A', strtotime($order->placed_at)) }}</p>
                    @if ($order->status == 'out_for_delivery')
                        <p class="mb-0"><span class="fw-semibold text-dark">Estimated Delivery:</span> 
                            {{ date('M. d, Y ', strtotime($order->expected_delivery_date)) }}
                        </p>
                        <p class="mb-1"><span class="fw-semibold text-dark">Courier:</span> {{ $order->shipment->courier ?? '---' }}</p>
                        <p class="mb-1"><span class="fw-semibold text-dark">Tracking Number:</span> 
                            @if($order->shipment->tracking_number)
                                <span class="text-primary fw-semibold">{{ $order->shipment->tracking_number }}</span>
                            @else
                                ---
                            @endif
                        </p>
                        @if($order->shipment->tracking_number && $order->shipment->courier)
                            @php
                                $courier = strtolower(optional($order->shipment)->courier ?? '');
                                $trackingNumber = optional($order->shipment)->tracking_number;

                                $trackingUrl = match (true) {
                                    str_contains($courier, 'j&t')        => 'https://www.jtexpress.ph/index/query/gzquery.html?billcode=' . $trackingNumber,
                                    default                              => null,
                                };
                            @endphp
                            @if($trackingUrl)
                                <a href="{{ $trackingUrl }}" target="_blank" class="text-decoration-none text-primary d-inline-block mt-1">
                                    <i class="fas fa-external-link-alt me-1"></i> Track this shipment
                                </a>
                            @endif
                        @endif
                    @endif
                    @if ($order->status == 'ready_for_pick_up')
                        <p class="mb-0"><span class="fw-semibold text-dark">Ready for picked up since:</span> 
                            {{ date('M. d, Y h:i A', strtotime($order->expected_delivery_date)) }}
                        </p>
                    @endif
                    @if($order->order_type == 'nationwide')
                        @if($order->shipment && in_array($order->status, ['shipped','out_for_delivery','completed']))
                            <hr class="my-2">
                            <p class="mb-1"><span class="fw-semibold text-dark">Courier:</span> {{ $order->shipment->courier ?? '---' }}</p>
                            <p class="mb-1"><span class="fw-semibold text-dark">Tracking Number:</span> 
                                @if($order->shipment->tracking_number)
                                    <span class="text-primary fw-semibold">{{ $order->shipment->tracking_number }}</span>
                                @else
                                    ---
                                @endif
                            </p>
                            <p class="mb-1"><span class="fw-semibold text-dark">Shipped At:</span> 
                                {{ $order->shipment->shipped_at ? date('M. d, Y - h:i A', strtotime($order->shipment->shipped_at)) : '---' }}
                            </p>
                            @if($order->shipment->tracking_number && $order->shipment->courier)
                                @php
                                    $courier = strtolower(optional($order->shipment)->courier ?? '');
                                    $trackingNumber = optional($order->shipment)->tracking_number;

                                    $trackingUrl = match (true) {
                                        str_contains($courier, 'j&t')        => 'https://www.jtexpress.ph/index/query/gzquery.html?billcode=' . $trackingNumber,
                                        default                              => null,
                                    };
                                @endphp
                                @if($trackingUrl)
                                    <a href="{{ $trackingUrl }}" target="_blank" class="text-decoration-none text-primary d-inline-block mt-1">
                                        <i class="fas fa-external-link-alt me-1"></i> Track this shipment
                                    </a>
                                @endif
                            @endif
                        @endif
                    @endif
                </div>
                <div class="bg-light p-3 rounded-3 border-start border-3 border-danger">
                    <h6 class="fw-bold text-danger mb-2"><i class="fas fa-map-marker-alt me-2"></i>Delivery Address</h6>
                    <p class="mb-1">{{ $order->address->street }}</p>
                    <p class="mb-1">{{ $order->address->barangay }}, {{ $order->address->city ?? '' }}</p>
                    <p class="mb-0">{{ $order->address->province }}</p>
                </div>
            </div>
        </div>
    </div>
    @php
        if ($order->status === 'cancelled') {
            $stages = ['cancelled']; 
        } elseif ($order->delivery_type == 'pick-up') {
            $stages = ['pending', 'ready_for_pick_up', 'completed'];
        } elseif ($order->order_type == 'nationwide') {
            $stages = ['pending', 'processing', 'shipped', 'completed'];
        } else {
            $stages = ['pending', 'processing', 'out_for_delivery', 'completed'];
        }
    @endphp
    <div class="d-none d-md-flex timeline justify-content-between mb-4">
        @foreach($stages as $stage)
            @php
                $currentStatus = $order->status;
                $isCompleted = !empty($currentStatus) && array_search($stage, $stages) <= array_search($currentStatus, $stages);
            @endphp
            <div class="text-center flex-fill">
                <div class="circle mb-2 mx-auto 
                    {{ $stage === 'cancelled' ? 'cancelled' : ($isCompleted ? 'completed' : 'initial') }}">
                    @if($stage === 'cancelled') &#10005;
                    @elseif($isCompleted) &#10003;
                    @else {{ strtoupper(substr($stage,0,1)) }} @endif
                </div>
                <div class="small">{{ ucfirst(str_replace('_',' ',$stage)) }}</div>
            </div>
        @endforeach
    </div>
    <div class="d-md-none fixed-bottom bg-white py-2 border-top shadow-sm py-3">
        <div class="d-flex justify-content-between px-2">
            @foreach($stages as $stage)
                @php
                    $currentStatus = $order->status;
                    $isCompleted = !empty($currentStatus) && array_search($stage, $stages) <= array_search($currentStatus, $stages);
                @endphp
                <div class="text-center flex-fill">
                    <div class="circle mb-1 mx-auto 
                        {{ $stage === 'cancelled' ? 'cancelled' : ($isCompleted ? 'completed' : 'initial') }}" style="width:30px; height:30px; line-height:30px; font-size:14px;">
                        @if($stage === 'cancelled') &#10005;
                        @elseif($isCompleted) &#10003;
                        @else {{ strtoupper(substr($stage,0,1)) }} @endif
                    </div>
                    <div class="small" style="font-size:10px;">{{ ucfirst(str_replace('_',' ',$stage)) }}</div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="card border-0 shadow-sm p-3 mb-5">
        @if($order->status === 'pending')
            <div class="text-end mb-3">
                <form action="{{ route('order.cancel', $order->order_id) }}" method="POST" 
                    onsubmit="return confirm('Are you sure you want to cancel this order?');">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-danger">
                        <i class="fas fa-times me-1"></i> Cancel Order
                    </button>
                </form>
            </div>
        @endif    
        <h4 class="fw-bold mb-3"><i class="fas fa-receipt me-2 text-primary"></i>Order Items</h4>
        <div class="table-responsive d-none d-md-block">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Image</th>
                        <th>Item</th>
                        <th class="text-center">Qty</th>
                        <th class="text-end">Price</th>
                        <th class="text-end">Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                        <tr>
                            <td style="width: 90px;">
                                <img src="{{ $item->product->image ? asset($item->product->image) : asset('images/placeholder.png') }}" 
                                     alt="Product image" 
                                     class="rounded shadow-sm" 
                                     style="width: 70px; height: 70px; object-fit: cover;">
                            </td>                            
                            <td class="fw-semibold text-dark">{{ $item->product->product_name ?? 'N/A' }}</td>
                            <td class="text-center">{{ $item->quantity }}</td>
                            <td class="text-end">₱{{ number_format($item->price, 2) }}</td>
                            <td class="text-end text-success fw-semibold">₱{{ number_format($item->quantity * $item->price, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-md-none">
            <div class="row g-3">
                @foreach($order->orderItems as $item)
                    <div class="col-12">
                        <div class="shadow-sm p-3 rounded-3 border bg-white">
                            <div class="d-flex align-items-center">
                                <img src="{{ $item->product->image ? asset($item->product->image) : asset('images/placeholder.png') }}"
                                     alt="Product Image"
                                     class="rounded me-3 shadow-sm"
                                     style="width: 80px; height: 80px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <div class="fw-semibold mb-1">{{ $item->product->product_name ?? 'N/A' }}</div>
                                    <div class="small text-muted">Qty: {{ $item->quantity }}</div>
                                </div>
                                <div class="text-end">
                                    <div class="fw-semibold">₱{{ number_format($item->price, 2) }}</div>
                                    <div class="small text-muted">Subtotal:</div>
                                    <div class="small fw-semibold text-success">
                                        ₱{{ number_format($item->quantity * $item->price, 2) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="border-top pt-3 mt-3 text-end">
            <p class="mb-1 text-muted">Delivery Fee: <span class="fw-semibold text-dark">₱{{ number_format($item->delivery_fee, 2) }}</span></p>
            <h5 class="fw-bold text-success">Total: ₱{{ number_format($order->grand_total, 2) }}</h5>
        </div>
    </div>
</div>
@endsection
