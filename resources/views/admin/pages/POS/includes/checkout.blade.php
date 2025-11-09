@php
    $subtotal = 0;
    if(!empty($cart)){
        foreach($cart as $id => $item){
            $subtotal += $item['price'] * $item['quantity'];
        }
    }
@endphp
<script src="{{ asset('script/admin/pos.js') }}"></script>
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.pos.checkout') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="checkoutModalLabel">Complete Checkout</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Enter Amount Paid</label>
                        <input type="number" id="amount_paid" name="amount_paid" class="form-control text-end fs-5 fw-bold" 
                            step="0.01" oninput="computeChange()" required>
                    </div>
                    <div class="d-grid gap-2">
                        @foreach([['7','8','9'],['4','5','6'],['1','2','3'],['0','C']] as $row)
                            <div class="d-flex">
                                @foreach($row as $btn)
                                    @if($btn === 'C')
                                        <button type="button" class="btn btn-outline-danger flex-fill fs-5" onclick="clearInput()">C</button>
                                    @else
                                        <button type="button" class="btn btn-light flex-fill fs-5" onclick="pressNum('{{ $btn }}')">{{ $btn }}</button>
                                    @endif
                                @endforeach
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-3 d-flex justify-content-between">
                        <span class="fw-bold">Total:</span>
                        <span class="text-success">₱{{ number_format($subtotal, 2) }}</span>
                    </div>
                    <div id="change_display" class="mt-2 fw-bold"></div>
                    <input type="hidden" id="change" name="change">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success w-100">
                        <span class="btn-text">Confirm Payment</span>
                        <span class="btn-loader spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="col-md-4 d-none d-md-block">
    <div class="card" style="height: 480px;">
        <div class="card-body" style="max-height: 340px; overflow-y: auto;">
            @if(empty($cart))
                <div class="text-center my-5">
                    <img src="{{ asset('storage/images/empty.gif') }}" alt="No Products" style="width: 150px;">
                    <div class="text-center text-muted">No items in cart</div>
                </div>
            @else
                @foreach($cart as $id => $item)
                    <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                        <div class="flex-grow-1">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="fw-bold" style="font-size:14px;">{{ $item['name'] }}</div>
                                <form method="POST" action="{{ route('admin.pos.cart.remove', $id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mt-1">
                                <small class="text-danger fw-bold">₱ {{ number_format($item['price'], 2) }}</small>
                                <small>QTY: {{ $item['quantity'] }}</small>
                            </div>
                        </div>
                    </div>                
                @endforeach
            @endif
        </div>

        @if(!empty($cart))
            <div class="px-3 py-2 border-top">
                <div class="d-flex justify-content-between fw-bold fs-5 mt-2">
                    <span>Total:</span>
                    <span class="text-success">₱{{ number_format($subtotal,2) }}</span>
                </div>
            </div>
        @endif

        @if(!empty($cart))
            <div class="card-footer text-end">
                <button type="button" class="btn btn-outline-success w-100" data-bs-toggle="modal" data-bs-target="#checkoutModal">
                    <i class="fas fa-check"></i> Checkout
                </button>
                @include('admin.pages.pos.create-sale')
            </div>
        @endif
    </div>
</div>

<!-- Mobile Cart -->
@if(!empty($cart))
    <div class="d-block d-md-none">
        <div class="card fixed-bottom shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <div>
                    <span class="fw-bold">Total:</span>
                    <span class="text-success">₱{{ number_format($subtotal,2) }}</span>
                </div>
                <div class="d-flex gap-2">
                    <button class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileCartSummary" aria-controls="mobileCartSummary">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#checkoutModal">
                        Checkout
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

<div class="offcanvas offcanvas-bottom" tabindex="-1" id="mobileCartSummary" aria-labelledby="mobileCartSummaryLabel" style="height:70%;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="mobileCartSummaryLabel">Cart Summary</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        @if(empty($cart))
            <div class="text-center my-3">
                <img src="{{ asset('storage/images/empty.gif') }}" alt="No Products" style="width: 120px;">
                <div class="text-muted">No items in cart</div>
            </div>
        @else
            @foreach($cart as $id => $item)
                <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                    <div>
                        <div class="fw-bold" style="font-size:14px;">{{ $item['name'] }}</div>
                        <small class="text-danger fw-bold">₱ {{ number_format($item['price'], 2) }}</small>
                        <small class="ms-2">QTY: {{ $item['quantity'] }}</small>
                    </div>
                    <form method="POST" action="{{ route('admin.pos.cart.remove', $id) }}">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            @endforeach
            <div class="d-flex justify-content-between fw-bold fs-5 mt-3">
                <span>Total:</span>
                <span class="text-success">₱{{ number_format($subtotal,2) }}</span>
            </div>
        @endif
    </div>
</div>
