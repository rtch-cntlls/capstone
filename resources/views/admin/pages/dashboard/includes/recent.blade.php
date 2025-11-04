<h6>Recent Products Added</h6>
<div style="font-size: 12.5px;">
    @if ($recentProducts->isEmpty())
        <div class="text-center my-2">
            <img src="{{ asset('images/empty.gif') }}" alt="No Products" style="width: 135px;">
            <p class="m-0">No recent products added</p>
        </div>
    @else
        @foreach ($recentProducts as $product)
            <div>
                <div class=" d-flex justify-content-between align-items-center p-1">
                    <div class="d-flex align-items-center gap-2">
                        <img src="{{ $product->image ? asset($product->image) : asset('images/placeholder.png') }}" width="35">
                        <div>
                            <div  class="fw-semibold text-truncate" style="max-width: 150px;">
                                {{ $product->product_name }}
                            </div>
                            <small class="text-muted">
                                {{ $product->created_at->format('M d, Y') }}
                            </small>
                        </div>
                    </div>
                   <div class="bg-primary bg-opacity-25 p-2 rounded">
                        <p class="m-0 text-dark fw-bold">
                            ₱{{ number_format($product->sale_price, 2) }}
                            <i class="fa fa-coins sm-2"></i>
                        </p>
                   </div>
                </div>
            </div>
        @endforeach
    @endif
</div>
