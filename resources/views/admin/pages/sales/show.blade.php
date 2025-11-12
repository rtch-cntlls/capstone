<div class="modal fade" id="saleModal{{ $sale->sale_id }}" tabindex="-1" aria-labelledby="saleModalLabel{{ $sale->sale_id }}" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold w-100 text-center" id="saleModalLabel{{ $sale->sale_id }}">
                    Invoice / Receipt
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body printable" id="printableSale{{ $sale->sale_id }}">
                <div class="text-center mb-3 border-bottom pb-2">
                    <h6 class="mb-0 fw-bold">{{ $shop->shop_name}}</h6>
                    <div>{{ $shop->barangay}}, {{ $shop->city}}, {{ $shop->province}}</div><br>
                </div>
                <div class="d-flex justify-content-between mb-2">
                    <div><span class="fw-bold">Invoice No:</span> #{{ $sale->sale_id }}</div>
                    <div><span class="fw-bold">Date:</span> {{ \Carbon\Carbon::parse($sale->sale_date)->format('M d, Y h:i A') }}</div>
                </div>
                <div class="d-flex justify-content-between mb-3">
                    <div><span class="fw-bold">Type:</span>
                        @if ($sale->sale_type === 'walk_in')
                            <span>Walk-in</span>
                        @else
                            <span>Online Order</span>
                        @endif
                    </div>
                </div>
                <div class="table-responsive table-wrapper">
                    <table class="table border-top border-bottom">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th class="text-end">Qty</th>
                                <th class="text-end">Price</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sale->items as $item)
                                <tr>
                                    <td class="text-start">{{ $item->product->product_name }}</td>
                                    <td class="text-end">{{ $item->quantity }}</td>
                                    <td class="text-end">{{ number_format($item->price, 2) }}</td>
                                    <td class="text-end">{{ number_format($item->total, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    <div class="d-flex justify-content-between">
                        <span>Discount/Promo:</span>
                        <span>₱ {{ number_format($sale->items->sum('discount'), 2) }}</span>
                    </div>
                    @if ($sale->sale_type === 'online_order')
                        <div class="d-flex justify-content-between">
                            <span>Delivery/Shipping Fee:</span>
                            <span>₱ {{ number_format($sale->order->orderItems->sum('delivery_fee') ?? 0, 2) }}</span>
                        </div>
                    @endif
                    <div class="d-flex justify-content-between mt-2">
                        <span class="fw-bold">Grand Total:</span>
                        <span class="fw-bold text-success">₱ {{ number_format($sale->grand_total, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between mt-2">
                        <span>Amount Paid:</span>
                        <span>₱ {{ number_format($sale->amount_pay, 2) }}</span>
                    </div>
                    <div class="d-flex justify-content-between border-top pt-2">
                        <span>Change:</span>
                        <span>₱ {{ number_format($sale->change, 2) }}</span>
                    </div>
                </div>
                <div class="text-center mt-3">
                    <div>Thank you for your purchase!</div><br>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="printSale({{ $sale->sale_id }})">Print</button>
            </div>
        </div>
    </div>
</div>
