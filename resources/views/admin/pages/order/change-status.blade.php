<div class="modal fade" id="actionModal{{ $order->order_id }}" tabindex="-1" aria-labelledby="actionModalLabel{{ $order->order_id }}" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content border-0 shadow-lg rounded-3">
            <div class="modal-header bg-primary text-white rounded-top-3">
                <h5 class="modal-title fw-semibold">
                    <i class="fas fa-receipt me-2"></i> Order #{{ $order->order_number }}
                </h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-3 mb-3">
                    <div class="col-6">
                        <span class="text-muted small">Payment Method</span>
                        <p class="mb-0 fw-bold">{{ strtoupper($order->payment_method ?? 'N/A') }}</p>
                    </div>
                    <div class="col-6">
                        <span class="text-muted small">Payment Status</span>
                        <p class="mb-0">
                            <span class="badge 
                                @if($order->payment_status == 'paid') bg-success 
                                @else bg-secondary @endif px-3 py-2">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </p>
                    </div>
                </div>
                <hr class="my-3">

                @php
                    if ($order->order_type === 'nationwide') {
                        $statuses = ['processing', 'shipped', 'completed', 'failed', 'cancelled'];
                    } elseif ($order->delivery_type === 'pick-up') {
                        $statuses = ['ready_for_pick_up', 'completed', 'cancelled'];
                    } elseif ($order->order_type === 'province' || $order->order_type === 'local') {
                        $statuses = ['processing', 'out_for_delivery', 'completed', 'cancelled'];
                    }
                @endphp            
                <form method="POST" action="{{ route('admin.orders.update', $order->order_id) }}">
                    @csrf
                    <label class="form-label fw-semibold d-block mb-2">Update Order Status</label>

                    @if($order->status == 'completed')
                        <div class="alert alert-info mt-2 mb-2 small rounded-3">
                            <i class="fas fa-info-circle me-1"></i> 
                            This order is <strong>completed</strong>. Status can no longer be updated.
                        </div>
                        <p class="small text-muted mb-0">
                            <i class="fas fa-calendar-check me-1 text-success"></i>
                            Completed on: 
                            <strong>{{ $order->updated_at->format('M. d, Y (h:i a)') }}</strong>
                        </p>

                    @elseif($order->status == 'cancelled')
                        <div class="alert alert-warning mt-2 mb-0 small rounded-3">
                            <i class="fas fa-ban me-1"></i> 
                            This order has been <strong>cancelled</strong>. Status can no longer be updated.
                        </div>

                    @elseif(in_array($order->status, ['failed','returned']))
                        <div class="alert alert-danger mt-2 mb-0 small rounded-3">
                            <i class="fas fa-times-circle me-1"></i> 
                            This order has been marked as <strong>{{ ucfirst($order->status) }}</strong>. Status can no longer be updated.
                        </div>

                    @elseif($order->status == 'out_for_delivery')
                        <div class="mb-2">
                            <p class="small text-muted mb-2">
                                <i class="fas fa-calendar-check me-1 text-primary"></i>
                                Estimated Delivery: 
                                <strong>{{ date('M. d, Y', strtotime($order->expected_delivery_date)) }}</strong><br>
                            </p>
                            <div class="mb-2">
                                @if(optional($order->shipment)->tracking_number && optional($order->shipment)->courier)
                                    @php
                                        $courierRaw = optional($order->shipment)->courier ?? '';
                                        $courier = strtolower($courierRaw);
                                        $trackingNumber = optional($order->shipment)->tracking_number;
    
                                        $trackingUrl = match (true) {
                                            str_contains($courier, 'j&t')        => 'https://www.jtexpress.ph/index/query/gzquery.html?billcode=' . $trackingNumber,
                                            default                              => null,
                                        };
                                    @endphp
                                    <div class="bg-light rounded p-2 d-flex flex-column flex-md-row gap-2 align-items-start align-items-md-center">
                                        <div class="me-md-3 small text-muted">
                                            <span class="fw-semibold">Courier:</span> <span class="text-dark">{{ $courierRaw }}</span>
                                        </div>
                                        <div class="small text-muted">
                                            <span class="fw-semibold">Tracking #:</span>
                                            <span class="text-dark" id="tracking_{{ $order->order_id }}">{{ $trackingNumber ?? 'N/A' }}</span>
                                            @if($trackingUrl)
                                                <a href="{{ $trackingUrl }}" target="_blank" class="small btn btn-sm btn-outline-primary ms-1">
                                                    <i class="fas fa-external-link-alt fa-sm "></i> Track Order
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="btn-group w-100 flex-wrap" role="group" aria-label="Order Status">
                            @foreach ($statuses as $status)
                                @php
                                    $disabled = false;
                                    if ($order->order_type !== 'nationwide') {
                                        if ($order->status == 'out_for_delivery' && in_array($status, ['processing',
                                        'out_for_delivery', 'completed'])) {
                                            $disabled = true;
                                        }
                                        if ($order->status == 'processing' && $status == 'processing') {
                                            $disabled = true;
                                        }
                                        if ($status == 'completed' && date('Y-m-d') == date('Y-m-d', strtotime($order->expected_delivery_date))) {
                                            $disabled = false;
                                        }
                                    }
                                @endphp
                                <input type="radio" class="btn-check status-radio" name="status" 
                                    id="status_{{ $order->order_id }}_{{ $status }}" value="{{ $status }}"  
                                    autocomplete="off" {{ $order->status == $status ? 'checked' : '' }}
                                    @if($disabled) disabled @endif >
                                <label class="btn btn-outline-primary text-capitalize px-3 py-2 
                                    @if($disabled) disabled opacity-50 @endif"
                                    for="status_{{ $order->order_id }}_{{ $status }}">
                                    {{ str_replace('_', ' ', $status) }}
                                </label>
                            @endforeach
                        </div>

                    @elseif($order->status == 'shipped')
                        <p class="small text-muted mb-2">
                            <i class="fas fa-calendar-check me-1 text-primary"></i>
                            Shipped on: 
                            <strong>{{ optional($order->shipment)->shipped_at?->format('M. d, Y (h:i a)') ?? 'N/A' }}</strong><br>
                        </p>
                        <div class="mb-2">
                            @if(optional($order->shipment)->tracking_number && optional($order->shipment)->courier)
                                @php
                                    $courierRaw = optional($order->shipment)->courier ?? '';
                                    $courier = strtolower($courierRaw);
                                    $trackingNumber = optional($order->shipment)->tracking_number;

                                    $trackingUrl = match (true) {
                                        str_contains($courier, 'j&t')        => 'https://www.jtexpress.ph/index/query/gzquery.html?billcode=' . $trackingNumber,
                                        default                              => null,
                                    };
                                @endphp
                                <div class="bg-light rounded p-2 d-flex flex-column flex-md-row gap-2 align-items-start align-items-md-center">
                                    <div class="me-md-3 small text-muted">
                                        <span class="fw-semibold">Courier:</span> <span class="text-dark">{{ $courierRaw }}</span>
                                    </div>
                                    <div class="small text-muted">
                                        <span class="fw-semibold">Tracking #:</span>
                                        <span class="text-dark" id="tracking_{{ $order->order_id }}">{{ $trackingNumber }}</span>
                                        @if($trackingUrl)
                                            <a href="{{ $trackingUrl }}" target="_blank" class="small btn btn-sm btn-outline-primary ms-1">
                                                <i class="fas fa-external-link-alt fa-sm "></i> Track Order
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="btn-group w-100 flex-wrap" role="group" aria-label="Order Status">
                            @foreach ($statuses as $status)
                                @php
                                    $disabled = false;

                                    if ($order->order_type === 'nationwide') {

                                        if ($order->status == 'shipped' && $status == 'processing') {
                                            $disabled = true;
                                        }
                                        if ($order->status == 'shipped' && $status == 'shipped') {
                                            $disabled = true;
                                        }
                                        if ($order->status == 'processing' && $status == 'processing') {
                                            $disabled = true;
                                        }
                                    }
                                @endphp
                                <input type="radio" class="btn-check status-radio" name="status" 
                                    id="status_{{ $order->order_id }}_{{ $status }}" value="{{ $status }}"  
                                    autocomplete="off" {{ $order->status == $status ? 'checked' : '' }}
                                    @if($disabled) disabled @endif >
                                <label class="btn btn-outline-primary text-capitalize px-3 py-2 
                                    @if($disabled) disabled opacity-50 @endif"
                                    for="status_{{ $order->order_id }}_{{ $status }}">
                                    {{ str_replace('_', ' ', $status) }}
                                </label>
                            @endforeach
                        </div>
                    @else
                        <div class="btn-group w-100 flex-wrap" role="group" aria-label="Order Status">
                            @foreach ($statuses as $status)
                                @php
                                    $disabled = false;
                                    
                                    if ($order->order_type !== 'nationwide') {
                                        if ($order->status == 'out_for_delivery' && in_array($status, ['processing','out_for_delivery'])) {
                                            $disabled = true;
                                        }
                                        if ($order->status == 'processing' && $status == 'processing') {
                                            $disabled = true;
                                        }
                                        if ($order->status == 'ready_for_pick_up' && $status == 'ready_for_pick_up') {
                                            $disabled = true;
                                        }
                                    } else {
                                        if ($order->status == 'shipped' && $status == 'processing') {
                                            $disabled = true;
                                        }
                                        if ($order->status == 'shipped' && $status == 'shipped') {
                                            $disabled = true;
                                        }
                                        if ($order->status == 'processing' && $status == 'processing') {
                                            $disabled = true;
                                        }
                                    }
                                @endphp
                                <input type="radio" class="btn-check status-radio" name="status" 
                                    id="status_{{ $order->order_id }}_{{ $status }}" value="{{ $status }}"  
                                    autocomplete="off" {{ $order->status == $status ? 'checked' : '' }}
                                    @if($disabled) disabled @endif >
                                <label class="btn btn-outline-primary text-capitalize px-3 py-2 
                                    @if($disabled) disabled opacity-50 @endif"
                                    for="status_{{ $order->order_id }}_{{ $status }}">
                                    {{ str_replace('_', ' ', $status) }}
                                </label>
                            @endforeach
                        </div>
                    @endif

                    @if($order->order_type === 'province' || $order->order_type === 'local')
                        <div id="deliveryDateWrapper_{{ $order->order_id }}" class="mt-3 d-none">
                            <label class="form-label fw-semibold">Courier</label>
                            <input type="text" class="form-control mb-2" name="courier" value="J&T Express" readonly>                              
                            <label class="form-label fw-semibold">Tracking Number</label>
                            <input type="text" class="form-control mb-2"
                                    name="tracking_number" value="{{ old('tracking_number', optional($order->shipment)->tracking_number) }}"
                                    placeholder="Enter tracking number">
                            <label for="estimated_date_{{ $order->order_id }}" class="form-label fw-semibold">
                                Estimated Delivery Date
                            </label>
                            <input type="date" class="form-control" id="estimated_date_{{ $order->order_id }}" 
                                name="estimated_date" value="{{ old('estimated_date') }}">
                            <small class="text-muted">Provide the expected date the customer will receive their order.</small>
                        </div>
                    @endif

                    @if($order->order_type === 'nationwide')
                        <div id="shippedWrapper_{{ $order->order_id }}" class="mt-3 d-none">
                            <label class="form-label fw-semibold">Courier</label>
                            <input type="text" class="form-control mb-2" name="courier" value="J&T Express" readonly>                              
                            <label class="form-label fw-semibold">Tracking Number</label>
                            <input type="text" class="form-control mb-2"
                                    name="tracking_number" value="{{ old('tracking_number', optional($order->shipment)->tracking_number) }}"
                                    placeholder="Enter tracking number">
                            <input type="hidden" name="shipped_at" value="{{ now() }}">
                        </div>
                    @endif

                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-sync-alt me-2"></i> Update Status
                        </button>
                    </div>
                </form>    
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('script/admin/order-status.js')}}"></script>
