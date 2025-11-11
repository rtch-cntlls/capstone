@php
    $hour = now()->format('H');

    if ($hour < 12) {
        $greeting = 'Good morning';
        $icon = '<i class="fa-solid fa-sunrise text-warning"></i>';
    } elseif ($hour < 18) {
        $greeting = 'Good afternoon';
        $icon = '<i class="fa-solid fa-sun text-warning"></i>';
    } else {
        $greeting = 'Good evening';
        $icon = '<i class="fa-solid fa-moon text-primary"></i>';
    }
@endphp

<div class="card">
    <div class="row g-0">
        <div class="col-md-6">
            <div class="p-4">
                <h4 class="fw-bold mb-2">
                    <span class="text-primary">{{ $greeting }}</span>, {{ Auth::user()->firstname }}! {!! $icon !!}
                </h4>
                <div>
                    <p class="text-muted small m-0">Today's sales</p>
                    <h5 class="fw-bold text-success mb-0"> ₱{{ $todaySales  }}</h5> 
                </div>
            </div>
        </div>
    </div>
</div>