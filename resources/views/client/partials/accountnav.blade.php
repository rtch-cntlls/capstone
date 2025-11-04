<div class="d-none d-md-block p-3 mt-3" style="width: 240px; font-size: 14px;">
    <ul class="nav flex-column">
        <li class="nav-item mb-2">
            <a href="{{ route('account.show') }}" 
               class="nav-link px-5 {{ request()->routeIs('account.show') ? 'bg-secondary-subtle text-dark' : 'text-dark' }}">
                Profile
            </a>
        </li>

        <li class="nav-item mb-2 d-flex justify-content-between align-items-center">
            <a href="{{ route('order.index') }}" 
               class="nav-link px-5 flex-grow-1 {{ request()->routeIs('order.index') ? 'bg-secondary-subtle text-dark' : 'text-dark' }}">
                My Order
            </a>
            @if(isset($orderCount) && $orderCount > 0)
                <span class="badge bg-danger rounded-pill me-3">{{ $orderCount }}</span>
            @endif
        </li>

        <li class="nav-item mb-2 d-flex justify-content-between align-items-center">
            <a href="{{ route('wishlist.index') }}" 
               class="nav-link px-5 flex-grow-1 {{ request()->routeIs('wishlist.index') ? 'bg-secondary-subtle text-dark' : 'text-dark' }}">
                Wishlist
            </a>
            @if(isset($wishlistCount) && $wishlistCount > 0)
                <span class="badge bg-danger rounded-pill me-3">{{ $wishlistCount }}</span>
            @endif
        </li>

        <li class="nav-item mb-2 d-flex justify-content-between align-items-center">
            <a href="{{ route('mybooking.index') }}" 
               class="nav-link px-5 flex-grow-1 {{ request()->routeIs('mybooking.index') ? 'bg-secondary-subtle text-dark' : 'text-dark' }}">
                Booking
            </a>
            @if(isset($bookingCount) && $bookingCount > 0)
                <span class="badge bg-danger rounded-pill me-3">{{ $bookingCount }}</span>
            @endif
        </li>

        <li class="nav-item mb-2 d-flex justify-content-between align-items-center">
            <a href="{{ route('garage.index') }}" 
               class="nav-link px-5 flex-grow-1 {{ request()->routeIs('garage.index') ? 'bg-secondary-subtle text-dark' : 'text-dark' }}">
                My Garage
            </a>
            @if(isset($garageCount) && $garageCount > 0)
                <span class="badge bg-danger rounded-pill me-3">{{ $garageCount }}</span>
            @endif
        </li>

        <li class="nav-item mb-2">
            <a href="{{ route('account.settings') }}" 
               class="nav-link px-5 {{ request()->routeIs('account.settings') ? 'bg-secondary-subtle text-dark' : 'text-dark' }}">
                Privacy Settings
            </a>
        </li>
    </ul>
</div>
