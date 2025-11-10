@extends('admin.layouts.admin')
@section('content')
@include('components.ModalAlertSuccess')
@include('components.ModalAlertError')
@include('admin.pages.booking.includes.cards')
<div class="card p-4 mx-2 shadow-sm">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold">Service Bookings</h5>
    </div>
    @if ($bookings->isEmpty())
        <div class="text-center my-4">
            <img src="{{ asset('storage/images/empty.gif') }}" alt="No Bookings" style="width: 200px;">
            <p class="m-0 fw-bold">No bookings found</p>
        </div>
    @else
        <div class="table-responsive table-wrapper">
            <table class="table table-hover align-middle" style="font-size: 14px;">
                <thead class="table-light">
                    <tr>
                        <th>Customer</th>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Schedule</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($bookings as $booking)
                        <tr>
                            <td>
                                {{ $booking->customer->user->firstname ?? '' }}
                                {{ $booking->customer->user->lastname ?? '' }}
                                @if ( $booking->customer->user->deleted_at)
                                    <span class="badge bg-danger ms-1">Deleted</span>
                                @endif
                            </td>
                            <td>{{ $booking->service->name ?? '---' }}</td>
                            <td>
                                <span class="badge 
                                    {{ $booking->status === 'Pending' ? 'bg-warning text-dark' : 
                                       ($booking->status === 'Approved' ? 'bg-success' : 'bg-secondary') }}">
                                    {{ ucfirst($booking->status) }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($booking->schedule)->format('M d, Y') }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-outline-primary"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#manageStatusModal{{ $booking->booking_id }}">
                                    Manage Status
                                </button>
                            </td>
                        </tr>
                        @include('admin.pages.booking.update-status')  
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <div class="p-2 mt-3">
        {{ $bookings->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
