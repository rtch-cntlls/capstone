<div class="p-2 mt-3">
    <div><h4 class="fw-bold m-0">Customer Management</h4></div>
</div>

<div>
    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-4 g-3 p-2 mb-2">
        @foreach ($cards as $card)
            <div class="col">
                @php
                    $barColor = $card['value'] > 0 ? 'bg-success' : 'bg-secondary';
                @endphp
                <div class="card h-100 hover-shadow">
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
