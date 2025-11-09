@php
    $hour = now()->format('H');
    if ($hour < 12) {
        $greeting = 'Good morning';
        $emoji = '🌅';
    } elseif ($hour < 18) {
        $greeting = 'Good afternoon';
        $emoji = '🌞';
    } else {
        $greeting = 'Good evening';
        $emoji = '🌙';
    }
@endphp
<div class="card">
    <div class="row g-0">
        <div class="col-md-6">
            <div class="p-4">
                <h4 class="fw-bold mb-2">
                    <span class="text-primary">{{ $greeting }}</span>, {{ Auth::user()->firstname }}! {{ $emoji }}
                </h4>
                <div>
                    <p class="text-muted small m-0">Today's sales</p>
                    <h5 class="fw-bold text-success mb-0"> ₱{{ number_format($todaySales ?? 0, 2) }}</h5> 
                </div>
            </div>
        </div>
    </div>
</div>