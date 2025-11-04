@extends('client.layouts.clientNoFooter')
@section('content')
@include('components.ModalAlertSuccess')
@include('components.ModalAlertError')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            @include('client.partials.accountnav')
        </div>
        <div class="col-md-9">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-start align-items-md-center">
                <h4 class="fw-bold m-0">My Bookings</h4>
                @include('client.pages.mybooking.includes.nav')
            </div>
            @if($bookings->isEmpty())
                <div class="text-center p-5 bg-white border rounded shadow-sm">
                    <img src="{{ asset('images/booking.jpg') }}" alt="" width="160">
                    <h5 class="fw-semibold">No Bookings Found</h5>
                    <p class="text-muted small mb-3">
                        You don’t have any bookings yet. Explore services to get started.
                    </p>
                    <a href="{{ route('shop-services.index') }}" class="btn btn-primary">
                        Book a Service
                    </a>
                </div>
            @else
                <div class="row g-1">
                    @foreach($bookings as $booking)
                        <div class="col-12">
                            <div class="card border rounded-3 h-100 
                                @if($booking->status == 'Cancelled') bg-light shadow-none @else shadow-sm @endif">
                                <div class="card-body">
                                    @if($booking->status == 'Cancelled')
                                        <div class="text-center p-1">
                                            <h5 class="fw-semibold text-muted mb-2">
                                                {{ $booking->service->name }}
                                            </h5>
                                            <span class="badge bg-dark mb-2">Cancelled</span>
                                            <p class="text-muted small mb-0">
                                                This booking was cancelled on 
                                                {{ \Carbon\Carbon::parse($booking->updated_at)->format('M d, Y h:i A') }}.
                                            </p>
                                        </div>
                                    @elseif($booking->status == 'Failed')
                                        <div class="text-center p-1">
                                            <h5 class="fw-semibold text-muted mb-2">
                                                {{ $booking->service->name }}
                                            </h5>
                                            <span class="badge bg-secondary mb-2">Failed</span>
                                            <p class="text-muted small mb-0">
                                                This booking was marked as <strong>Failed</strong> on 
                                                {{ \Carbon\Carbon::parse($booking->updated_at)->format('M d, Y h:i A') }}.  
                                                Please contact the shop for details.
                                            </p>
                                        </div>
                                    @elseif($booking->status == 'Completed')
                                        <div class="text-center p-1">
                                            <h5 class="fw-semibold text-success mb-2">
                                                {{ $booking->service->name }}
                                            </h5>
                                            <span class="badge bg-primary mb-2">Completed</span>
                                            <p class="text-muted small mb-0">
                                                This booking was completed on 
                                                {{ \Carbon\Carbon::parse($booking->updated_at)->format('M d, Y h:i A') }}.  
                                                Thank you for using our service!
                                            </p>
                                        </div>
                                    @else
                                        <div class="d-flex justify-content-between align-items-start mb-3">
                                            <div>
                                                <h5 class="fw-semibold mb-1">{{ $booking->service->name }}</h5>
                                                <small class="text-muted">
                                                    Booking ID: #{{ $booking->code }}
                                                </small>
                                            </div>
                                            <span class="badge
                                                @if($booking->status == 'Pending') bg-warning text-dark
                                                @elseif($booking->status == 'Approved') bg-success
                                                @elseif($booking->status == 'Rescheduled') bg-danger
                                                @elseif($booking->status == 'Completed') bg-primary
                                                @elseif($booking->status == 'Failed') bg-secondary
                                                @else bg-light text-dark @endif">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </div>
                                        <hr class="text-muted">
                                        <div class="row mb-3">
                                            <div class="col-md-6 mb-2">
                                                <small class="text-muted d-block">Schedule</small>
                                                @if($booking->status === 'Rescheduled' && $booking->previous_schedule)
                                                    <span class="fw-medium text-danger">
                                                        New: {{ \Carbon\Carbon::parse($booking->schedule)->format('M d, Y') }}
                                                    </span>
                                                    <br>
                                                    <small class="text-muted">
                                                        Previous: {{ \Carbon\Carbon::parse($booking->previous_schedule)->format('M d, Y') }}
                                                    </small>
                                                @else
                                                    <span class="fw-medium">
                                                        {{ \Carbon\Carbon::parse($booking->schedule)->format('M d, Y') }}
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="col-md-6 mb-2">
                                                <small class="text-muted d-block">Price</small>
                                                <span class="fw-bold text-success">
                                                    ₱{{ number_format($booking->service->price, 2) }}
                                                </span>
                                            </div>
                                            @if($booking->notes)
                                                <div class="col-12">
                                                    <small class="text-muted d-block">Notes</small>
                                                    <span class="text-muted ">{{ $booking->notes }}</span>
                                                </div>
                                            @endif
                                        </div>
                                        @if(in_array($booking->status, ['Pending', 'Rescheduled']))
                                            <div class="mt-3">
                                                <form action="{{ route('mybooking.booking.cancel', $booking->booking_id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-sm btn-outline-danger">
                                                        Cancel Booking
                                                    </button>
                                                </form>
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="mt-4">
                    {{ $bookings->links('pagination::bootstrap-5') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
