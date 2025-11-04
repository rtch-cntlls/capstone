{{-- <div class="px-3 mt-3 booking-nav">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ request('status') === null ? 'active' : '' }}"
               href="{{ route('admin.bookings.index') }}">
                All
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === 'Pending' ? 'active' : '' }}"
               href="{{ route('admin.bookings.index', ['status' => 'Pending']) }}">
                Pending
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === 'Completed' ? 'active' : '' }}"
               href="{{ route('admin.bookings.index', ['status' => 'Completed']) }}">
                Completed
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === 'Cancelled' ? 'active' : '' }}"
               href="{{ route('admin.bookings.index', ['status' => 'Cancelled']) }}">
                Cancelled
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === 'Failed' ? 'active' : '' }}"
               href="{{ route('admin.bookings.index', ['status' => 'Failed']) }}">
                Failed
            </a>
        </li>
    </ul>
</div> --}}
