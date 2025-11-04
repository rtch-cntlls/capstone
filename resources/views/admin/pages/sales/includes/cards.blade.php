<div class="d-flex justify-content-between align-items-center p-2 mt-3">
    <h4 class="fw-bold mb-0">Sale Transaction</h4>
    <div class="d-flex">           
        <a href="{{ route('admin.pos.index') }}" class="btn btn-primary">
            <i class="fa fa-plus me-2"></i> Add New Sale
        </a>
        <div class="dropdown ms-2">
            <button class="btn btn-white border border-dark dropdown-toggle" type="button" id="exportDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="font-size: 12px;">
                <i class="fas fa-file-export me-1"></i>
                <span class="fw-bold">Export</span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="exportDropdown" style="font-size: 13px;">
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.sales.export.pdf') }}">
                        <i class="fas fa-file-pdf text-danger me-2"></i> Export as PDF
                    </a>
                </li>
                <li>
                    <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.sales.export.csv') }}">
                        <i class="fas fa-file-csv text-success me-2"></i> Export as CSV
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
<div>
    <div class="row row-cols-2 row-cols-sm-2 row-cols-md-4 g-3 p-2 mb-2">
        @foreach ($cards as $card)
            <div class="col">
                @php
                    $barColor = $card['value'] > 0 ? 'bg-success' : 'bg-secondary';
                    $typeMap = [
                        'Online Orders' => 'online_order',
                        'Walk-in Sales' => 'walk_in',
                        'Total Sales'   => 'all',
                    ];
                    $saleType = $typeMap[$card['title']] ?? 'all';
                    $cardLink = route('admin.sales.index', ['sale_type' => $saleType]);
                @endphp

                <a href="{{ $cardLink }}" class="text-decoration-none">
                    <div class="card h-100 hover-shadow">
                        <div class="card-body">
                            <div class="card-title mb-2 small text-muted text-start mb-4">
                                <i class="{{ $card['icon'] }} me-1"></i>
                                <span>{{ $card['title'] }}</span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <span class="fw-bold fs-3 d-block {{ $card['color'] }}">
                                        {{ $card['value'] ?? 0 }}
                                    </span>
                                    <small class="text-muted">{{ $card['type'] ?? '' }}</small>
                                </div>
                                <div class="fake-chart ms-2 d-flex align-items-end">
                                    <div class="bar {{ $barColor }}" style="height: 20px;"></div>
                                    <div class="bar {{ $barColor }}" style="height: 30px;"></div>
                                    <div class="bar {{ $barColor }}" style="height: 15px;"></div>
                                    <div class="bar {{ $barColor }}" style="height: 25px;"></div>
                                    <div class="bar {{ $barColor }}" style="height: 35px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>