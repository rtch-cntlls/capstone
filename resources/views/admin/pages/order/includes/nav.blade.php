<div class="px-3">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ request('status') === null ? 'active' : '' }}"
               href="{{ route('admin.orders.index') }}">
                All
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === 'Pending' ? 'active' : '' }}"
               href="{{ route('admin.orders.index', ['status' => 'Pending']) }}">
                Pending
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === 'completed' ? 'active' : '' }}"
               href="{{ route('admin.orders.index', ['status' => 'completed']) }}">
                Completed
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === 'cancelled' ? 'active' : '' }}"
               href="{{ route('admin.orders.index', ['status' => 'cancelled']) }}">
                Cancelled
            </a>
        </li>
    </ul>
</div>