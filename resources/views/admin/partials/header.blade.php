@if(Auth::check() && Auth::user()->role_id == 1)
<div class="bg-white border-bottom shadow-sm py-3 px-4 header-top">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <button class="btn btn-outline-secondary me-3" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>
            <img src="{{ asset('images/primary-logo.png')}}" alt="" width="50" class="me-2">
            <h5 class="m-0 fw-bold">
                <span class="text-primary">MOTO</span><span class="text-dark">SMART</span>
            </h5>
        </div>
        <a class="text-decoration-none text-danger" href="{{ route('admin.logout')}}"><i class="fa-solid fa-right-from-bracket me-2"></i> Logout</a>
    </div>
</div> 
<script src="{{ asset('script/toggle.js') }}"></script>
@endif
