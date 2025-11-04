<style>
    .skeleton {
    background: linear-gradient(90deg, #e5e5e5 25%, #f0f0f0 37%, #e5e5e5 63%);
    border-radius: 4px;
    background-size: 400% 100%;
    animation: shimmer 1.4s ease infinite;
    }
    @keyframes shimmer {
        0% { background-position: -400px 0; }
        100% { background-position: 400px 0; }
    }
    .h-4 { height: 16px; }
    .w-16 { width: 4rem; }
    .w-20 { width: 5rem; }
    .w-24 { width: 6rem; }
    .mx-auto { margin-left: auto; margin-right: auto; }
</style>
<div class="skeleton-wrapper">
    @for ($i = 0; $i < 5; $i++)
        <div class="row align-items-center p-3 border animate-pulse">
            <div class="col-md-2 text-center"><div class="skeleton h-4 w-16 mx-auto"></div></div>
            <div class="col-md-2"><div class="skeleton h-4 w-24"></div></div>
            <div class="col-md-2 text-center"><div class="skeleton h-4 w-20 mx-auto"></div></div>
            <div class="col-md-2 text-center"><div class="skeleton h-4 w-24 mx-auto"></div></div>
            <div class="col-md-2 text-center"><div class="skeleton h-4 w-16 mx-auto"></div></div>
            <div class="col-md-2 text-center"><div class="skeleton h-4 w-20 mx-auto"></div></div>
        </div>
    @endfor
</div>