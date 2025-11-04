<div class="w-100 bg-light sticky-top">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid d-flex justify-content-between align-items-center px-0">
                <a class="navbar-brand fw-bold" href="/">
                    {{ $shop->shop_name}}
                </a>
                <div class="d-flex align-items-center">
                    <a href="{{ route('cart.index') }}" class="nav-link me-3 d-flex align-items-center position-relative">
                        <i class="fas fa-shopping-cart text-primary fs-5"></i>
                        <span class="ms-1 d-none d-md-inline">Cart</span>
                    
                        @if($cartCount > 0)
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $cartCount }}
                            </span>
                        @endif
                    </a>                    
                    @if(Auth::check() && Auth::user()->role_id == 2)
                        @php
                            $user = Auth::user();
                            $avatar = $user->avatar ?? $user->profile ?? asset('profile/customer.webp');
                        @endphp
                        <div class="dropdown">
                            <a href="#" class="nav-link text-dark" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <img src="{{ $avatar }}" alt="Profile Picture" width="25" class="rounded-circle">
                                <span class="ms-1">{{ $user->firstname }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end p-2 profile" aria-labelledby="profileDropdown">
                                <div class="text-center">
                                    <img src="{{ Auth::user()->profile ?? asset('profile/customer.webp') }}" 
                                    alt="Profile Picture" width="70" class="rounded-circle mb-2">
                                    <div>
                                        <p>{{ Auth::user()->email }}</p>
                                    </div>
                                </div><hr>
                                <li><a class="dropdown-item" href="{{ route('account.show')}}">
                                    <i class="far fa-user me-2"></i>My Profile
                                </a></li> 
                                <li>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{ route('order.index') }}">
                                        <div><i class="fas fa-shopping-bag me-2"></i>My Order</div>
                                        @if(isset($orderCount) && $orderCount > 0)
                                            <span class="badge bg-danger rounded-pill">{{ $orderCount }}</span>
                                        @endif
                                    </a>
                                </li>                                
                                <li>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{ route('wishlist.index') }}">
                                        <div><i class="far fa-heart me-2"></i>Wishlist</div>
                                        @if(isset($wishlistCount) && $wishlistCount > 0)
                                            <span class="badge bg-danger rounded-pill">{{ $wishlistCount }}</span>
                                        @endif
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{ route('mybooking.index')}}">
                                        <div><i class="fas fa-calendar-day me-2"></i>Booking</div>
                                        @if(isset($bookingCount) && $bookingCount > 0)
                                            <span class="badge bg-danger rounded-pill">{{ $bookingCount }}</span>
                                        @endif
                                    </a>
                                </li>                                
                                <li>
                                    <a class="dropdown-item d-flex justify-content-between align-items-center" href="{{ route('garage.index')}}">
                                        <div><i class="fas fa-motorcycle me-1"></i>My Garage</div>
                                        @if(isset($garageCount) && $garageCount > 0)
                                            <span class="badge bg-danger rounded-pill">{{ $garageCount }}</span>
                                        @endif
                                    </a>
                                </li>                                
                                <li><a class="dropdown-item" href="{{ route('account.settings')}}">
                                    <i class="fas fa-gear me-2"></i>Privacy Settings
                                </a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form action="{{ route('auth.logout') }}" method="POST">
                                        @csrf
                                        <button class="btn btn-outline-danger w-100" type="submit">
                                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <div class="d-flex gap-2 align-items-center">
                            <a href="{{ route('auth.customer.login') }}" class="nav-link text-primary">Login</a> | 
                            <a href="{{ route('auth.customer.register') }}" class="nav-link text-success">Sign Up</a>
                        </div>
                    @endif
                </div>
            </div>
        </nav>
    </div>
    @include('client.partials.nav')
</div>
