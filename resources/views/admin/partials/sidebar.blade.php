@php
    $EcommerceSubmenuRoutes = ['product.*', 'orders.*', 'customer.*', 'refund.*', 'promo.*'];
    $ServiceSubmenuRoutes = ['services.*', 'bookings.*', 'service-logs.*'];
    $AnalyticsSubmenuRoutes = ['overview.*', 'sales-report.*', 'service-report.*'];
@endphp
<div id="sidebarWrapper">
    <aside>
        <div class="bg-white p-2 border-end sidebar">
            <ul class="nav flex-column" style="font-size: 13px;">
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.dashboard.index') }}" class="nav-link 
                    {{ request()->routeIs('admin.dashboard.index') ? 'rounded bg-primary-subtle text-primary' : 'text-dark' }}">
                        <i class="fas fa-house ms-3 me-1"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.inventory.index') }}" class="nav-link   
                    {{ request()->routeIs('admin.inventory.index') ? 'rounded bg-primary-subtle text-primary' : 'text-dark' }}">
                        <i class="fas fa-boxes ms-3 me-1"></i> Inventory
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.pos.index') }}" class="nav-link   
                    {{ request()->routeIs('admin.pos.index') ? 'rounded bg-primary-subtle text-primary' : 'text-dark' }}">
                        <i class="fas fa-cash-register ms-3 me-1"></i> Point of Sale
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.sales.index') }}" class="nav-link   
                    {{ request()->routeIs('admin.sales.index') ? 'rounded bg-primary-subtle text-primary' : 'text-dark' }}">
                        <i class="fas fa-credit-card ms-3 me-1"></i> Transaction
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="#ecommerceSubmenu" class="nav-link text-dark d-flex align-items-center" data-bs-toggle="collapse"
                        aria-expanded="{{ request()->routeIs($EcommerceSubmenuRoutes) ? 'true' : 'false' }}">
                        <i class="fas fa-caret-right me-2 triangle-icon fa-sm text-secondary {{ request()->routeIs($EcommerceSubmenuRoutes) ? 'rotate' : '' }}"></i>
                        <i class="fas fa-shopping-bag me-2"></i> E-commerce
                    </a>
                    <ul id="ecommerceSubmenu" class="collapse list-unstyled ps-5 {{ request()->routeIs($EcommerceSubmenuRoutes) ? 'show' : '' }}">
                        <li><a href="{{ route('admin.product.index') }}" 
                            class="nav-link {{ request()->routeIs('admin.product.index') ? 'text-primary' : 'text-dark' }}">Products</a></li>
                        <li><a href="{{ route('admin.orders.index') }}" 
                            class="nav-link {{ request()->routeIs('admin.orders.index') ? 'text-primary' : 'text-dark' }}">Order</a></li>
                        <li><a href="{{ route('admin.customer.index') }}" 
                            class="nav-link {{ request()->routeIs('admin.customer.index') ? 'text-primary' : 'text-dark' }}">Customer</a></li>
                        <li><a href="{{ route('admin.promo.index') }}" 
                            class="nav-link {{ request()->routeIs('admin.promo.index') ? 'text-primary' : 'text-dark' }}">Promo & Discount</a></li>
                    </ul>
                </li>
                <li class="nav-item mb-2">
                    <a href="#analyticsSubmenu" class="nav-link text-dark d-flex align-items-center" data-bs-toggle="collapse"
                        aria-expanded="{{ request()->routeIs($AnalyticsSubmenuRoutes) ? 'true' : 'false' }}">
                        <i class="fas fa-caret-right me-2 triangle-icon fa-sm text-secondary {{ request()->routeIs($AnalyticsSubmenuRoutes) ? 'rotate' : '' }}"></i>
                        <i class="fas fa-chart-pie me-2"></i>Analytics
                    </a>
                    <ul id="analyticsSubmenu" class="collapse list-unstyled ps-5 {{ request()->routeIs($AnalyticsSubmenuRoutes) ? 'show' : '' }}">
                        <li><a href="{{ route('admin.overview.index') }}" 
                            class="nav-link {{ request()->routeIs('admin.overview.index') ? 'text-primary' : 'text-dark' }}">Overview</a></li>
                            <li>
                        <li><a href="{{ route('admin.sale-report.index') }}" 
                            class="nav-link {{ request()->routeIs('admin.sale-report.index') ? 'text-primary' : 'text-dark' }}">Sales Report</a></li>
                        <li><a href="{{ route('admin.service-report.index') }}" 
                            class="nav-link {{ request()->routeIs('admin.service-report.index') ? 'text-primary' : 'text-dark' }}">Service Report</a></li>
                    </ul>
                </li>  
                <li class="nav-item mb-2">
                    <a href="#serviceSubmenu" class="nav-link text-dark d-flex align-items-center" data-bs-toggle="collapse"
                        aria-expanded="{{ request()->routeIs($ServiceSubmenuRoutes) ? 'true' : 'false' }}">
                        <i class="fas fa-caret-right me-2 triangle-icon fa-sm text-secondary {{ request()->routeIs($ServiceSubmenuRoutes) ? 'rotate' : '' }}"></i>
                        <i class="fas fa-user-gear me-2"></i> Services
                    </a>
                    <ul id="serviceSubmenu" class="collapse list-unstyled ps-5 {{ request()->routeIs($ServiceSubmenuRoutes) ? 'show' : '' }}">
                        <li><a href="{{ route('admin.services.index') }}" 
                            class="nav-link {{ request()->routeIs('admin.services.index') ? 'text-primary' : 'text-dark' }}">Service List</a></li>
                        <li>
                        <li><a href="{{ route('admin.bookings.index') }}" 
                            class="nav-link {{ request()->routeIs('admin.bookings.index') ? 'text-primary' : 'text-dark' }}">Booking</a></li>
                        <li>
                        <li><a href="{{ route('admin.service-logs.index') }}" 
                            class="nav-link {{ request()->routeIs('admin.service-logs.index') ? 'text-primary' : 'text-dark' }}">Service Log</a></li>
                        <li>
                    </ul>
                </li>                
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.messages.index') }}" class="nav-link   
                    {{ request()->routeIs('admin.messages.index') ? 'rounded bg-primary-subtle text-primary' : 'text-dark' }}">
                        <i class="fas fa-comment ms-3 me-1"></i> Messages
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.settings.index')}}" class="nav-link 
                        {{ request()->routeIs('admin.settings.index') ? 'rounded bg-primary-subtle text-primary' : 'text-dark' }}">
                        <i class="fas fa-gear ms-3 me-1"></i> Settings
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a href="{{ route('admin.logout')}}" class="nav-link text-dark">
                        <i class="fas fa-sign-out-alt ms-3 me-1"></i> Logout
                    </a>
                </li>
            </ul>
        </div>
    </aside>
</div>
