<div class="modal fade" id="viewOrderModal{{ $product_order->order_id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header bg-primary text-white rounded-top-3">
                <h5 class="modal-title fw-semibold">
                    <i class="fas fa-box me-2"></i> Order #{{ $product_order->order_number }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-4">
                    <div>
                        <p class="mb-1 fw-semibold">Customer Name</p>
                        <p class="mb-0">{{ $product_order->customer->user->firstname }} {{ $product_order->customer->user->lastname }}</p>
                    </div>
                    <div>
                        <p class="mb-1 fw-semibold">Email Address</p>
                        <p class="mb-0">{{ $product_order->customer->user->email }}</p>
                    </div>
                    <div>
                        <p class="mb-1 fw-semibold">Phone no.</p>
                        <p class="mb-0">{{ $product_order->customer->phone ?? 'N/A'}}</p>
                    </div>
                    <div class="text-end">
                        <p class="mb-1 fw-semibold">Delivery Address</p>
                        <p class="mb-0 text-muted small">
                            {{ $product_order->address->street }},
                            {{ $product_order->address->barangay }},
                            {{ $product_order->address->city }},
                            {{ $product_order->address->province }}
                        </p>
                    </div>
                </div>
                <div class="table-responsive border rounded">
                    <table class="table align-middle mb-0">
                        <thead class="table-light">
                            <tr class="text-center">
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Discount</th>
                                <th>Delivery Fee</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product_order->orderItems as $item)
                                <tr class="text-center">
                                    <td>
                                        <div class="d-flex flex-column align-items-center">
                                            <img src="{{ $item->product->image ? asset($item->product->image) : asset('images/placeholder.png') }}" 
                                                 alt="Product Image" class="img-fluid rounded" width="50">
                                            <small class="text-muted mt-1">{{ $item->product->name ?? 'Product' }}</small>
                                        </div>
                                    </td>
                                    <td>₱{{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td class="text-danger">-₱{{ number_format($item->discount, 2) }}</td>
                                    <td>₱{{ number_format($item->delivery_fee, 2) }}</td>
                                    <td class="fw-bold text-success">₱{{ number_format($item->total, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="5" class="text-end fw-bold fs-5">Grand Total:</td>
                                <td class="fw-bold fs-5 text-success">₱{{ number_format($product_order->grand_total, 2) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
