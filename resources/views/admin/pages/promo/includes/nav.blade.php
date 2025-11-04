<div class="px-3" style="font-size: 15px;">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ request('status') === 'Active' || !request('status') ? 'active' : '' }}"
               href="{{ route('admin.promo.index', ['status' => 'Active']) }}">
                Active
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === 'Upcoming' ? 'active' : '' }}"
               href="{{ route('admin.promo.index', ['status' => 'Upcoming']) }}">
                Upcoming
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === 'Expired' ? 'active' : '' }}"
               href="{{ route('admin.promo.index', ['status' => 'Expired']) }}">
                Expired
            </a>
        </li>
    </ul>
</div>
