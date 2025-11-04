
<div class="p-3 bg-white border shadow-sm flex-grow-1 d-flex flex-column">
    <h3 class="fw-bold text-primary">Order Summary</h3>
    @if($selectedItems->count() > 0)
        <ul class="list-group mb-3 flex-grow-1 overflow-auto">
            @php $total = 0; @endphp
            @foreach ($selectedItems as $item)
                @php $total += $item->total_price; @endphp
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <div class="text-truncate" style="max-width:200px;" title="{{ $item->product->product_name }}">
                        <span class="fw-semibold small">{{ $item->product->product_name }}</span>
                        <span class="text-muted small"> (x{{ $item->quantity }})</span>
                    </div>
                    <span class="fw-bold ms-2 flex-shrink-0">
                        ₱{{ number_format($item->total_price,2) }}
                    </span>
                </li>
            @endforeach
        </ul>
        <div class="mt-auto">
            <div class="d-flex justify-content-between fw-bold fs-5 border-top pt-2 mb-2">
                <span>Total:</span>
                <span class="text-danger">₱{{ number_format($total,2) }}</span>
            </div>
            <form action="{{ route('cart.checkoutSelected') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success w-100 mt-3">
                    Proceed to Checkout
                </button>
            </form>
        </div>
    @else
        <div class="text-center mb-4 flex-grow-1 d-flex flex-column justify-content-center">
            <p class="text-muted m-0 mt-2">No products selected.</p>
        </div>
    @endif
</div>
