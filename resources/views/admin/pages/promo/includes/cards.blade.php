<div class="d-flex justify-content-between align-items-center">
    <div>
        <h4 class="fw-bold m-0">Promos & Discounts Management</h4>
    </div>
    @if ($promo->isNotEmpty())
        <a href="{{ route('admin.promo.create') }}" class="btn btn-outline-primary shadow-sm">
            <i class="fa fa-plus me-1"></i> New Promo
        </a>
    @endif
</div>
<div>
    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-4 g-3 mb-2 mt-1">
        @foreach ($cards as $card)
            @php
                $barColor = $card['value'] > 0 ? 'bg-success' : 'bg-secondary';
                $status = strtolower(str_replace(' ', '_', $card['title']));
                $cardLink = route('admin.promo.index', ['status' => $status]);
            @endphp
            <div class="col">
                <div class="card h-100 shadow-sm hover-shadow" onclick="window.location='{{ $cardLink }}'" style="cursor:pointer;">
                    <div class="card-body">
                        <div class="card-title mb-2 small text-muted text-start mb-4">
                            <i class="{{ $card['icon'] }} me-1"></i>
                            <span>{{ $card['title'] }}</span>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="fw-bold fs-3 d-block {{ $card['color'] }}">
                                    {{ $card['value'] ?? 0 }}
                                </span>
                                <small class="text-muted">{{ $card['type'] ?? '' }}</small>
                            </div>
                            <div class="fake-chart ms-2 d-flex align-items-end">
                                <div class="bar {{ $barColor }}" style="height: 20px;"></div>
                                <div class="bar {{ $barColor }}" style="height: 30px;"></div>
                                <div class="bar {{ $barColor }}" style="height: 15px;"></div>
                                <div class="bar {{ $barColor }}" style="height: 25px;"></div>
                                <div class="bar {{ $barColor }}" style="height: 35px;"></div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        @endforeach
    </div>
</div>
