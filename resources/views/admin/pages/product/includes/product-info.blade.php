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
                <p class="mb-1 text-muted small d-flex justify-content-between">
                    Category:
                    <strong class="text-dark">{{ $product->category->name }}</strong>
                </p>
                @php
                    $fullDescription = $product->description;
                    $shortDescription = Str::limit($product->description, 100);
                    $isLong = strlen($product->description) > 100;
                @endphp
                <p class="mb-0 text-muted small">
                    Description:
                    <span class="text-dark" id="desc-{{ $product->product_id }}">
                        {{ $shortDescription }}
                    </span>
                    @if($isLong)
                        <button type="button"
                                class="btn btn-link btn-sm p-0 text-primary text-decoration-none see-more-desc"
                                data-full="{{ e($fullDescription) }}"
                                data-short="{{ e($shortDescription) }}"
                                data-target="desc-{{ $product->product_id }}">
                            See more
                        </button>
                    @endif
                </p>
            </div>
        </div>
    </div>
</li>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.see-more-desc').forEach(button => {
            button.addEventListener('click', function () {
                const targetId = this.getAttribute('data-target');
                const descElement = document.getElementById(targetId);
                const isExpanded = this.textContent.trim() === 'See less';
                const fullText = this.getAttribute('data-full');
                const shortText = this.getAttribute('data-short');

                descElement.textContent = isExpanded ? shortText : fullText;

                this.textContent = isExpanded ? 'See more' : 'See less';
            });
        });
    });
</script>
    