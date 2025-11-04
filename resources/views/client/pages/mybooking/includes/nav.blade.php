<div>
    <ul class="nav nav-tabs flex-nowrap mb-3" style="white-space: nowrap;">
        <li class="nav-item">
            <a class="nav-link {{ request('status') === null ? 'active' : '' }}"
               href="{{ route('mybooking.index') }}">
                All
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === 'Completed' ? 'active' : '' }}"
               href="{{ route('mybooking.index', ['status' => 'Completed']) }}">
                Completed
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === 'Cancelled' ? 'active' : '' }}"
               href="{{ route('mybooking.index', ['status' => 'Cancelled']) }}">
                Cancelled
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === 'Failed' ? 'active' : '' }}"
               href="{{ route('mybooking.index', ['status' => 'Failed']) }}">
                Failed
            </a>
        </li>
    </ul>
</div>
