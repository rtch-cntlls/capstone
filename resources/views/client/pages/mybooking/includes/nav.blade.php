<div>
    <ul class="nav nav-tabs flex-nowrap my-3 gap-3" style="white-space: nowrap;">
        <li class="nav-item">
            <a class="nav-link position-relative {{ request('status') === null ? 'active' : '' }}"
               href="{{ route('mybooking.index') }}">
                All
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link position-relative {{ request('status') === 'Completed' ? 'active' : '' }}"
               href="{{ route('mybooking.index', ['status' => 'Completed']) }}">
                Completed
                @if(($completedCount ?? 0) > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                          style="font-size: 0.65rem;">
                        {{ $completedCount ?? 0 }}
                    </span>
                @endif
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link position-relative {{ request('status') === 'Cancelled' ? 'active' : '' }}"
               href="{{ route('mybooking.index', ['status' => 'Cancelled']) }}">
                Cancelled
                @if(($cancelledCount ?? 0) > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                          style="font-size: 0.65rem;">
                        {{ $cancelledCount ?? 0 }}
                    </span>
                @endif
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link position-relative {{ request('status') === 'Failed' ? 'active' : '' }}"
               href="{{ route('mybooking.index', ['status' => 'Failed']) }}">
                Failed
                @if(($failedCount ?? 0) > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                          style="font-size: 0.65rem;">
                        {{ $failedCount ?? 0 }}
                    </span>
                @endif
            </a>
        </li>
    </ul>
</div>
