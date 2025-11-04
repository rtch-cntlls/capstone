<div class="px-3">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{ request('status') === null ? 'active' : '' }}"
               href="{{ route('admin.services.index') }}">
                All
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === 'Active' ? 'active' : '' }}"
               href="{{ route('admin.services.index', ['status' => 'Active']) }}">
                Active
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request('status') === 'Inactive' ? 'active' : '' }}"
               href="{{ route('admin.services.index', ['status' => 'Inactive']) }}">
                Inactive
            </a>
        </li>
        <li class="nav-item">
    </ul>
</div>