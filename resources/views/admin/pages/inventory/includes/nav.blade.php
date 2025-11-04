<div class="px-3">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ request('status') === 'in_stock' ? 'active' : '' }}"
               href="{{ route('admin.inventory.index', ['status' => 'in_stock']) }}">
                In Stock
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === 'low_stock' ? 'active' : '' }}"
               href="{{ route('admin.inventory.index', ['status' => 'low_stock']) }}">
                Low Stock
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === 'out_of_stock' ? 'active' : '' }}"
               href="{{ route('admin.inventory.index', ['status' => 'out_of_stock']) }}">
                Out of Stock
            </a>
        </li>
    </ul>    
</div>
