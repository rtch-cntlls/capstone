<div class="modal fade" id="productsModal{{ $promos->discount_id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content shadow rounded-3 border-0">
            <div class="modal-header bg-primary text-white rounded-top-3">
                <h6 class="modal-title fw-semibold m-0">
                    <i class="fa fa-box-open me-2"></i>
                    Linked Products - <span class="fw-bold">{{ $promos->title }}</span>
                </h6>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-2">
                @if($promos->products->isNotEmpty())
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($promos->products as $product)
                                    <tr>
                                        <td class="fw-medium">
                                            <img src="{{ $product->image ? asset($product->image) : asset('images/placeholder.png') }}" 
                                            width="50" class="me-2">
                                            {{ $product->product_name }}                                       
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.product.show', ['id' => $product->product_id]) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-eye me-1"></i> View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-5">
                        <i class="fa fa-cube fa-2x text-muted mb-3"></i>
                        <p class="text-muted mb-0">No products linked to this promo yet.</p>
                    </div>
                @endif
            </div>
            <div class="modal-footer bg-light border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
