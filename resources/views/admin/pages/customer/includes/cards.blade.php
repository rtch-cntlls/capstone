<div class="p-2 mt-3">
    <div><h4 class="fw-bold m-0">Customer Management</h4></div>
</div>

<div>
    <div class="row row-cols-1 row-cols-md-2 p-2 mb-2">
        @foreach ($cards as $card)
            <div class="col">
                @php
                    $barColor = $card['value'] > 0 ? 'bg-success' : 'bg-secondary';
                    $growth = $card['growth'] ?? 0;
                @endphp
                <div class="card h-100 hover-shadow" style="min-height: 200px;">
                    <div class="card-body p-4">
                        <div class="card-title mb-3 small text-muted text-start">
                            <i class="{{ $card['icon'] }} me-1"></i>
                            <span>{{ $card['title'] }}</span>
                        </div>

                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <span class="fw-bold fs-2 d-block {{ $card['color'] }}">
                                    {{ $card['value'] ?? 0 }}
                                </span>
                                <small class="text-muted d-block">
                                    {{ $card['type'] ?? '' }}
                                </small>
                                <div class="mt-2 small">
                                    @if ($growth > 0)
                                        <span class="text-success">
                                            <i class="fas fa-arrow-up me-1"></i>
                                            +{{ number_format($growth, 1) }}%
                                        </span>
                                        <span class="text-muted">vs last 30 days</span>
                                    @elseif ($growth < 0)
                                        <span class="text-danger">
                                            <i class="fas fa-arrow-down me-1"></i>
                                            {{ number_format($growth, 1) }}%
                                        </span>
                                        <span class="text-muted">vs last 30 days</span>
                                    @else
                                        <span class="text-muted">0% vs last 30 days</span>
                                    @endif
                                </div>
                            </div>
                            <div class="fake-chart ms-3 d-flex align-items-end">
                                <div class="bar {{ $barColor }}" style="height: 30px; width: 6px; margin-right: 2px;"></div>
                                <div class="bar {{ $barColor }}" style="height: 45px; width: 6px; margin-right: 2px;"></div>
                                <div class="bar {{ $barColor }}" style="height: 25px; width: 6px; margin-right: 2px;"></div>
                                <div class="bar {{ $barColor }}" style="height: 40px; width: 6px; margin-right: 2px;"></div>
                                <div class="bar {{ $barColor }}" style="height: 55px; width: 6px;"></div>
                            </div>
                        </div>
                    </div> 
                </div>
            </div>
        @endforeach
    </div>
</div>
