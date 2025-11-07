<div class="modal fade" id="colorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Colors / Finishes</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @php
                    $colors = [
                        'Black', 'Matte Black', 'Gloss Black',
                        'Silver', 'Chrome', 'Gray', 'Gunmetal',
                        'Gold', 'Rose Gold', 'Bronze', 'Titanium', 'Carbon Fiber', 'Anodized', 'Polished Aluminum',
                        'Red', 'Matte Red', 'Blue', 'Matte Blue', 'Royal Blue',
                        'Yellow', 'Neon Yellow', 'Green', 'Lime Green',
                        'Orange', 'Purple', 'White',
                        'Two-Tone', 'Brushed Metal', 'Matte Finish', 'Gloss Finish',
                        'Iridescent', 'Rainbow', 'Oil Slick', 'Electroplated', 'Transparent',
                        'Other'
                    ];
                @endphp
                <div class="d-flex flex-wrap gap-2">
                    @foreach($colors as $col)
                        <button type="button" class="btn btn-outline-secondary btn-sm color-btn" data-value="{{ $col }}">
                            {{ $col }}
                        </button>
                    @endforeach
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Done</button>
            </div>
        </div>
    </div>
</div>
