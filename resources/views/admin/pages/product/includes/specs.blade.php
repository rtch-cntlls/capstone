<li class="mb-3 position-relative ps-1">
    <div class="row gx-3 align-items-start">
        <div class="col-auto position-relative z-1 icon">
            <span class="d-flex align-items-center justify-content-center bg-info text-white rounded-circle"
                  style="width: 36px; height: 36px;">
                <i class="fas fa-cogs small"></i>
            </span>
        </div>
        <div class="col p-2">
            <h6 class="fw-semibold text-dark">Product Specs</h6>
            <div class="mt-2 p-3 bg-light rounded">
                @php
                    $specs = json_decode($product->specs, true) ?? [];
                @endphp
                @if(count($specs) > 0 || $product->weight_kg || $product->material || $product->color_finish)
                    <ul class="list-unstyled mb-0 small text-muted">
                        @if($product->weight_kg)
                            <li class="d-flex justify-content-between mb-1">
                                <span>Weight:</span>
                                <span class="text-dark">{{ $product->weight_kg }} kg</span>
                            </li>
                        @endif
                        @if($product->material)
                            <li class="d-flex justify-content-between mb-1">
                                <span>Material:</span>
                                <span class="text-dark">{{ $product->material }}</span>
                            </li>
                        @endif
                        @if($product->color_finish)
                            <li class="d-flex justify-content-between mb-1">
                                <span>Color / Finish:</span>
                                <span class="text-dark">{{ $product->color_finish }}</span>
                            </li>
                        @endif
                        @foreach($specs as $key => $value)
                            <li class="d-flex justify-content-between mb-1">
                                <span>{{ ucwords(str_replace('_', ' ', $key)) }}:</span>
                                <span class="text-dark">{{ $value ?: '-' }}</span>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="mb-0 text-muted small">No specific specs available.</p>
                @endif
            </div>
        </div>
    </div>
</li>
