<div>
    <ul class="nav nav-tabs flex-nowrap mb-3" style="white-space: nowrap;">
        <li class="nav-item">
            <a class="nav-link {{ request('status') === null ? 'active' : '' }}"
               href="{{ route('order.index') }}">
                All
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === 'completed' ? 'active' : '' }}"
               href="{{ route('order.index', ['status' => 'completed']) }}">
                Completed
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === 'cancelled' ? 'active' : '' }}"
               href="{{ route('order.index', ['status' => 'cancelled']) }}">
                Cancelled
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === 'failed' ? 'active' : '' }}"
               href="{{ route('order.index', ['status' => 'failed']) }}">
                Failed
            </a>
        </li>
    </ul>
</div>
