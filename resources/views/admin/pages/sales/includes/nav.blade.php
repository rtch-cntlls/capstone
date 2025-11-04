<div class="px-3" style="font-size: 15px;">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ request('sale_type') === 'all' || !request('sale_type') ? 'active' : '' }}"
               href="{{ route('admin.sales.index', ['sale_type' => 'all']) }}">
                All
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('sale_type') === 'online_order' ? 'active' : '' }}"
               href="{{ route('admin.sales.index', ['sale_type' => 'online_order']) }}">
                 Online Order
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('sale_type') === 'walk_in' ? 'active' : '' }}"
               href="{{ route('admin.sales.index', ['sale_type' => 'walk_in']) }}">
                 Walk-in
            </a>
        </li>
    </ul>
</div>