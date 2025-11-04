<li class="mb-3 position-relative ps-1">
    <div class="row gx-3 align-items-start">
        <div class="col-auto position-relative z-1 icon">
            <span class="d-flex align-items-center justify-content-center bg-info text-white rounded-circle"
                  style="width: 36px; height: 36px;">
                <i class="fas fa-boxes small"></i>
            </span>
        </div>
        <div class="col p-2">
            <h6 class="fw-semibold text-dark">Product Description</h6>
            <div class="mt-2 p-3 bg-light rounded">
                <p class="mb-1 text-muted small d-flex justify-content-between">Category:
                    <strong class="text-dark">{{ $product->category->name }}</strong>
                </p>
                <p class="mb-0 text-muted small">Description:
                    <span class="text-dark">{{ $description }}</span>
                    @if(!$full && strlen($product->description) > 100)
                    <a href="{{ request()->url() }}?full=1" class="text-primary">See more</a>
                @elseif($full)
                    <a href="{{ request()->url() }}" class="text-primary">See less</a>
                @endif
                </p>
            </div>
        </div>
    </div>
</li>