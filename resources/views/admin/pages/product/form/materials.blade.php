<div class="modal fade" id="materialModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Select Materials</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @php
                    $materials = [
                        'Steel', 'Stainless Steel', 'Aluminum', 'Billet Aluminum', 'Cast Iron',
                        'Titanium', 'Carbon Steel', 'Alloy Steel', 'Chromoly', 'Brass', 'Copper', 'Zinc Alloy',
                        'Plastic', 'ABS Plastic', 'Polycarbonate', 'Fiberglass', 'Carbon Fiber', 'Reinforced Polymer', 'Nylon',
                        'Rubber', 'Silicone', 'Neoprene', 'Polyurethane (PU)', 'Foam', 'PVC',
                        'Leather', 'Synthetic Leather', 'Vinyl', 'Acrylic', 'Glass',
                        'Ceramic', 'Copper Wire', 'Composite Material', 'Heat-Resistant Material',
                        'Mixed Materials', 'Other'
                    ];
                @endphp
                <div class="d-flex flex-wrap gap-2">
                    @foreach($materials as $mat)
                        <button type="button" class="btn btn-outline-secondary btn-sm material-btn" data-value="{{ $mat }}">
                            {{ $mat }}
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

