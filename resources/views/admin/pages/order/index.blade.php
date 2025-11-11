@extends('admin.layouts.admin')
@section('content')
@include('admin.pages.order.includes.cards')
<div class="card p-4 mx-2 mb-3 shadow-sm rounded-3" style="font-size: 14px;">
    @if (session('success-alert'))
        <x-alert type="success" :message="session('success-alert')" />
    @endif
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
        <div class="d-flex gap-2 mb-3">

            <form method="GET" action="">
                <input type="search" name="search" value="{{ request('search') }}" 
                       class="form-control form-control-sm" 
                       placeholder="Search by customer name" 
                       aria-label="Search by customer name">
                <input type="hidden" name="order_type" value="{{ request('order_type') }}">
            </form>

            <form method="GET" action="">
                <select name="order_type" class="form-select form-select-sm" onchange="this.form.submit()">
                    <option value="">All Order Types</option>
                    <option value="local" @if(request('order_type')=='local') selected @endif>Local</option>
                    <option value="province" @if(request('order_type')=='province') selected @endif>Province</option>
                    <option value="nationwide" @if(request('order_type')=='nationwide') selected @endif>Nationwide</option>
                </select>
                <input type="hidden" name="search" value="{{ request('search') }}">
            </form>
        </div>        
    </div>
    @if ($orders->isEmpty())
        <div class="text-center my-5">
            <img src="{{ asset('images/empty.gif') }}" alt="No Orders" style="width: 160px;" class="mb-3">
            <p class="m-0 text-muted">No orders found</p>
        </div>
    @else
        <div class="table-responsive table-wrapper ">
            <table class="table align-middle table-hover">
                <thead class="table-light">
                    <tr class="text-center">
                        <th>Order #</th>
                        <th class="text-start">Customer</th>
                        <th>Status</th>
                        <th>Payment</th>
                        <th>Delivery</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td class="text-primary fw-semibold text-center">#{{ $order->order_number }}</td>
                            <td class="d-flex align-items-center gap-2">
                                <img src="{{ $order->customer->user->profile ?? asset('profile/customer.webp') }}" 
                                    alt="" width="32" height="32" class="rounded-circle object-fit-cover">
                                {{ $order->customer->user->firstname }} {{ $order->customer->user->lastname }}
                                @if ($order->customer->user->deleted_at)
                                    <span class="badge bg-danger ms-1">Deleted</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="badge rounded-pill px-3 py-2
                                    @if($order->status == 'completed') bg-success
                                    @elseif($order->status == 'processing') bg-info text-dark
                                    @elseif($order->status == 'cancelled') bg-danger
                                    @elseif($order->status == 'out_for_delivery') bg-warning text-dark
                                    @else bg-secondary
                                    @endif">
                                    {{ ucwords(str_replace('_', ' ', $order->status)) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge rounded-pill 
                                    @if($order->payment_status == 'paid') bg-success 
                                    @else bg-secondary 
                                    @endif">
                                    {{ strtoupper($order->payment_status) }}
                                </span>
                            </td>
                            <td class="text-center text-muted fw-bold small">
                                {{ strtoupper($order->delivery_type) }}
                            </td>
                            <td class="text-center">
                                {{ $order->created_at->format('M d, Y') }}
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm">
                                    <a href="javascript:void(0);" class="btn btn-outline-primary" 
                                     title="View Details" data-bs-toggle="modal" data-bs-target="#viewOrderModal{{ $order->order_id }}">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($order->payment_proof)
                                    <button type="button" class="btn btn-outline-success" 
                                            title="View Payment Proof"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#paymentProofModal{{ $order->order_id }}">
                                        <i class="fas fa-receipt"></i>
                                    </button>
                                    @endif
                                    <button type="button" class="btn btn-outline-secondary"
                                            title="Update Status"
                                            data-bs-toggle="modal" 
                                            data-bs-target="#actionModal{{ $order->order_id }}">
                                        <i class="fas fa-pencil-alt"></i>
                                    </button>
                                </div>
                                @include('admin.pages.order.show', ['product_order' => $order])
                                @include('admin.pages.order.change-status')
                            </td>
                        </tr>
                        @if($order->payment_proof)
                            <div class="modal fade" id="paymentProofModal{{ $order->order_id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                    <div class="modal-content">
                                        <div class="modal-body text-center">
                                            <img src="{{ asset($order->payment_proof) }}" alt="Payment Proof" 
                                                class="img-fluid rounded shadow-sm" width="250">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif                        
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
