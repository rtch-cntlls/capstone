<div class="bg-white border-bottom w-100">
    <div class="container">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center gap-3 ms-auto" style="font-size: 13px; padding: 0px 30px">
                    <a href="{{ route('shop') }}"
                        class="nav-link me-3 {{ request()->routeIs('shop') ? 'text-decoration-underline text-primary' : 'text-dark' }}">
                        Products
                    </a>
                    <a href="{{ route('shop-services.index') }}"
                    class="nav-link me-3 {{ request()->routeIs('shop-services.index') ? 
                    'text-decoration-underline text-primary' : 'text-dark' }}">Services
                </a>
                    <a href="{{ route('contact.index') }}"
                        class="nav-link me-3 {{ request()->routeIs('contact.index') ? 
                        'text-decoration-underline text-primary' : 'text-dark' }}">Contact us
                    </a>
                </div>
            </div>
        </nav>    
    </div>
</div>