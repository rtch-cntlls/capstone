<a class="text-decoration-none mb-3 text-dark d-inline-block" href="{{ route('garage.index') }}">
    <i class="fas fa-arrow-left me-1"></i> Back
</a>

<ul class="nav nav-tabs mb-3">
    <li class="nav-item">
        <a href="{{ route('garage.show', $motorcycle->motorcycle_id) }}"
           class="nav-link {{ request()->routeIs('garage.show') ? 'active' : '' }}">
            <i class="fas fa-info-circle me-2 fs-6"></i>
            <span class="d-none d-md-inline">Common Issues & Troubleshooting</span>
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('garage.schedule', $motorcycle->motorcycle_id) }}"
           class="nav-link {{ request()->routeIs('garage.schedule') ? 'active' : '' }}">
            <i class="fas fa-history me-1"></i>
            <span class="d-none d-md-inline">Service Schedule</span>
        </a>
    </li>
    <li class="nav-item">
        <a 
            href="{{ route('garage.maintenance', $motorcycle->motorcycle_id) }}"
            class="nav-link {{ request()->routeIs('garage.maintenance') ? 'active' : '' }}">
            <i class="fas fa-tools me-1"></i>
            <span class="d-none d-md-inline">Maintenance History</span>
        </a>
    </li>
</ul>
