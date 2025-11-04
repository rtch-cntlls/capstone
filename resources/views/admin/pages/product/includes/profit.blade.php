<li class="mb-3 position-relative ps-1">
    <div class="row gx-3 align-items-start">
        <div class="col-auto position-relative z-1 icon">
            <span class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle"
                  style="width: 36px; height: 36px;">
                <i class="fas fa-chart-line small"></i>
            </span>
        </div>
        <div class="col p-2">
            <h6 class="fw-semibold text-dark">Profit Calculations</h6>
            <div class="mt-2 p-3 bg-light rounded">
                <p class="mb-1 text-muted small d-flex justify-content-between">Profit Margin:
                    <strong class="text-dark">{{ number_format($profitMargin, 2)}}%</strong>
                </p>
                <p class="mb-0 text-muted small d-flex justify-content-between">Markup Percentage:
                    <strong class="text-dark">{{ number_format($markup, 2) }}%</strong>
                </p>
            </div>
        </div>
    </div>
</li>