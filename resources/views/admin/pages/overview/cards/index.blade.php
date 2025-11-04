<div class="row p-2">
    @foreach ($cards as $card)
        @php
            $growthColor = $card['growth']['percent'] > 0 
                ? 'text-success' 
                : ($card['growth']['percent'] < 0 
                    ? 'text-danger' 
                    : 'text-secondary');
            $barColor = $card['growth']['percent'] > 0 
                ? 'bg-success' 
                : ($card['growth']['percent'] < 0 
                    ? 'bg-danger' 
                    : 'bg-secondary');
            $icon = $card['growth']['percent'] > 0 
                ? 'fa-arrow-up' 
                : ($card['growth']['percent'] < 0 
                    ? 'fa-arrow-down' 
                    : 'fa-minus');
        @endphp
        <div class="col-6 col-md-4 mb-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="card-title mb-2 small text-muted text-start mb-4">
                        <span>{{ $card['title'] }}</span>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="fw-bold fs-3 d-block">
                                {{ $card['type'] }}{{ $card['value'] }}
                            </span>
                            <small class="text-muted">
                                <span class="{{ $growthColor }}">
                                    <i class="fa-solid {{ $icon }}"></i>
                                    {{ abs($card['growth']['percent']) }}%
                                </span>
                                <span>vs last 30 days</span>
                            </small>
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