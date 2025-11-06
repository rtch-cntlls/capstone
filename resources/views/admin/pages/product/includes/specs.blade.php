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
                    $specs = collect(json_decode($product->specs, true) ?? [])
                        ->reject(fn($value) => $value === '-' || $value === null || trim($value) === '');

                    $specList = collect([
                        'Weight' => $product->weight_kg ? $product->weight_kg . ' kg' : null,
                        'Material' => $product->material,
                        'Color / Finish' => $product->color_finish,
                    ])->filter()->merge($specs);

                    $id = 'specList-' . $product->id;
                @endphp

                @if($specList->isNotEmpty())
                    <ul class="list-unstyled mb-0 small text-muted">
                        @foreach($specList->take(5) as $key => $value)
                            <li class="d-flex justify-content-between mb-1">
                                <span>{{ ucwords(str_replace('_', ' ', $key)) }}:</span>
                                <span class="text-dark">{{ $value }}</span>
                            </li>
                        @endforeach
                    </ul>

                    @if($specList->count() > 5)
                        <div class="collapse" id="{{ $id }}">
                            <ul class="list-unstyled mb-0 small text-muted mt-2">
                                @foreach($specList->slice(5) as $key => $value)
                                    <li class="d-flex justify-content-between mb-1">
                                        <span>{{ ucwords(str_replace('_', ' ', $key)) }}:</span>
                                        <span class="text-dark">{{ $value }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <button class="btn btn-sm btn-link p-0 mt-2 text-decoration-none see-more-btn"
                                type="button" data-bs-toggle="collapse" data-bs-target="#{{ $id }}" aria-expanded="false"
                                aria-controls="{{ $id }}"> See more
                        </button>
                    @endif
                @else
                    <p class="mb-0 text-muted small">No specific specs available.</p>
                @endif
            </div>
        </div>
    </div>
</li>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.see-more-btn').forEach(button => {
            const collapseTarget = document.querySelector(button.dataset.bsTarget);
            collapseTarget.addEventListener('shown.bs.collapse', () => {
                button.textContent = 'See less';
            });
            collapseTarget.addEventListener('hidden.bs.collapse', () => {
                button.textContent = 'See more';
            });
        });
    });
    </script>
    