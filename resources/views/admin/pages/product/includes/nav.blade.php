<div class="px-3">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ request('status') === 'active' ? 'active' : '' }}"
               href="{{ route('admin.product.index', ['status' => 'active']) }}">
                Active
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === 'inactive' ? 'active' : '' }}"
               href="{{ route('admin.product.index', ['status' => 'inactive']) }}">
                Inactive
            </a>
        </li>
    </ul>    
</div>
