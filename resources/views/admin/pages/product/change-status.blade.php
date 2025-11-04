<div class="modal fade" id="statusModal{{ $product->product_id }}" tabindex="-1" 
    aria-labelledby="statusModalLabel{{ $product->product_id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form method="POST" action="{{ route('admin.product.status', ['id' => $product->product_id]) }}">
           @csrf
            <div class="modal-content border-0 shadow">
                <div class="modal-header {{ $product->status === 'Active' ? 'bg-danger' : 'bg-primary' }} text-white">
                   <h5 class="modal-title fw-semibold" id="statusModalLabel{{ $product->product_id }}">
                       {{ $product->status === 'Active' ? 'Deactivate Product' : 'Activate Product' }}
                   </h5>
                   <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-2">
                        Are you sure you want to 
                        <span class="fw-bold">
                            {{ $product->status === 'Active' ? 'deactivate' : 'activate' }}
                        </span> this product?
                    </p>
                    <div class="d-flex align-items-center gap-3">
                        <div class="card">
                            <img src="{{ $product->image ? asset($product->image) : asset('images/placeholder.png') }}" 
                                width="80">
                        </div>
                        <div>
                            <p class="fw-medium">{{ $product->product_name }}</p>
                            <p class="fw-medium">
                                ₱{{ number_format($product->sale_price, 2) }}
                                @if($product->discounts->isNotEmpty())
                                    <span class="text-danger">({{ (int) $product->discount->first()->discount_percent }}% OFF)</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                   <button type="button" class="btn btn-outline-secondary btn-sm" data-bs-dismiss="modal">
                       Cancel
                   </button>
                   <button type="submit" class="btn btn-{{ $product->status === 'Active' ? 'danger' : 'primary' }} btn-sm">
                       {{ $product->status === 'Active' ? 'Deactivate' : 'Activate' }}
                   </button>
                </div>
            </div>
        </form>
    </div>
</div>
