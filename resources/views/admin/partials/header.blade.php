@if(Auth::check() && Auth::user()->role_id == 1)
<div class="bg-white border-bottom shadow-sm py-3 px-4 header-top">
    <div class="d-flex justify-content-between align-items-center">
        <div class="d-flex align-items-center">
            <button class="btn btn-outline-secondary me-3" id="toggleSidebar">
                <i class="fas fa-bars"></i>
            </button>
            <img src="{{ asset('storage/images/primary-logo.png')}}" alt="Logo" width="50" class="me-2">
            <h5 class="m-0 fw-bold">
                <span class="text-primary">MOTO</span><span class="text-dark">SMART</span>
            </h5>
        </div>
        <div class="d-flex align-items-center">
            <div class="dropdown me-4">
                @php
                    $totalNotifications = ($notifications['newOrders'] ?? 0) + ($notifications['newBookings'] ?? 0);
                @endphp
                <a class="text-decoration-none text-dark position-relative" href="#" role="button" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-bell fa-lg"></i>
                    @if($totalNotifications > 0)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $totalNotifications }}
                            <span class="visually-hidden">unread notifications</span>
                        </span>
                    @endif
                </a>

                @php
                $totalNotifications = ($notifications['newOrders'] ?? 0) 
                                    + ($notifications['newBookings'] ?? 0)
                                    + ($notifications['newReviews'] ?? 0);
            @endphp
            
            <ul class="dropdown-menu dropdown-menu-end p-0 shadow-lg" style="width: 320px; max-height: 400px; overflow-y: auto;">
                <li class="dropdown-header fw-bold bg-light py-2 px-3">Notifications</li>
                <li><hr class="dropdown-divider m-0"></li>
            
                @if($totalNotifications === 0)
                    <li class="text-center py-3 text-muted">
                        <i class="fas fa-bell-slash fa-lg mb-1"></i><br>
                        No new notifications
                    </li>
                @else
                    @if(($notifications['newOrders'] ?? 0) > 0)
                        <li>
                            <a href="{{ route('admin.orders.index') }}" class="dropdown-item d-flex align-items-start py-2">
                                <i class="fas fa-shopping-cart text-primary me-2 mt-1"></i>
                                <div class="flex-grow-1">
                                    <div class="fw-bold">New Orders</div>
                                    <small class="text-muted">{{ $notifications['newOrders'] }} new order(s) today</small>
                                </div>
                            </a>
                        </li>
                    @endif
            
                    @if(($notifications['newBookings'] ?? 0) > 0)
                        <li>
                            <a href="{{ route('admin.bookings.index') }}" class="dropdown-item d-flex align-items-start py-2">
                                <i class="fas fa-calendar-check text-success me-2 mt-1"></i>
                                <div class="flex-grow-1">
                                    <div class="fw-bold">New Bookings</div>
                                    <small class="text-muted">{{ $notifications['newBookings'] }} new booking(s) today</small>
                                </div>
                            </a>
                        </li>
                    @endif
            
                    @if(($notifications['newReviews'] ?? 0) > 0)
                        <li>
                            <a href="{{ route('admin.product.index') }}" class="dropdown-item d-flex align-items-start py-2">
                                <i class="fas fa-star text-warning me-2 mt-1"></i>
                                <div class="flex-grow-1">
                                    <div class="fw-bold">New Product Ratings/Comments</div>
                                    <small class="text-muted">{{ $notifications['newReviews'] }} new review(s) today</small>
                                </div>
                            </a>
                        </li>
                    @endif
                @endif
            </ul>
            
            </div>
            <a class="text-decoration-none text-danger d-flex align-items-center" href="{{ route('admin.logout') }}">
                <i class="fa-solid fa-right-from-bracket me-2"></i> Logout
            </a>
        </div>
    </div>
</div>

<script src="{{ asset('script/toggle.js') }}"></script>
<script>
    const dropdownMenu = document.querySelector('#notificationDropdown + .dropdown-menu');
    if(dropdownMenu) {
        dropdownMenu.addEventListener('wheel', e => e.stopPropagation());
    }
</script>
@endif
