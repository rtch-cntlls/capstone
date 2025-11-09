<div>
    <ul class="nav nav-tabs flex-nowrap my-3 gap-3" style="white-space: nowrap;">
        <li class="nav-item">
            <a class="nav-link position-relative {{ $status === null ? 'active' : '' }}"
               href="{{ route('order.index') }}">
                All
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link position-relative {{ $status === 'completed' ? 'active' : '' }}"
               href="{{ route('order.index', ['status' => 'completed']) }}">
                Completed
                @if(($counts['completed'] ?? 0) > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                          style="font-size: 0.65rem;">
                        {{ $counts['completed'] ?? 0 }}
                    </span>
                @endif
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link position-relative {{ $status === 'cancelled' ? 'active' : '' }}"
               href="{{ route('order.index', ['status' => 'cancelled']) }}">
                Cancelled
                @if(($counts['cancelled'] ?? 0) > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                          style="font-size: 0.65rem;">
                        {{ $counts['cancelled'] ?? 0 }}
                    </span>
                @endif
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link position-relative {{ $status === 'failed' ? 'active' : '' }}"
               href="{{ route('order.index', ['status' => 'failed']) }}">
                Failed
                @if(($counts['failed'] ?? 0) > 0)
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
                          style="font-size: 0.65rem;">
                        {{ $counts['failed'] ?? 0 }}
                    </span>
                @endif
            </a>
        </li>
    </ul>
</div>
