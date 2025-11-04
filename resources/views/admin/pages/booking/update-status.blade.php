<div class="modal fade" id="manageStatusModal{{ $booking->booking_id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form method="POST" action="{{ route('admin.bookings.update', $booking->booking_id) }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Manage Booking Status # <span class="fw-bold">{{ $booking->code}}</span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><span class="fw-bold">Customer:</span> {{ $booking->customer->user->firstname }} {{ $booking->customer->user->lastname }}</p>
                    <p><span class="fw-bold">Service:</span> {{ $booking->service->name }}</p>
                    @if ($booking->status === 'Rescheduled' && $booking->previous_schedule)
                        <p>
                            <span class="fw-bold">Requested Schedule:</span> 
                            {{ \Carbon\Carbon::parse($booking->previous_schedule)->format('M d, Y') }}
                        </p>
                        <p>
                            <span class="fw-bold">Rescheduled To:</span> 
                            {{ \Carbon\Carbon::parse($booking->schedule)->format('M d, Y') }}
                        </p>
                    @else
                        <p>
                            <span class="fw-bold">Requested Schedule:</span> 
                            {{ \Carbon\Carbon::parse($booking->schedule)->format('M d, Y') }}
                        </p>
                    @endif
                    @if ($booking->status === 'Pending')
                        <div class="alert alert-info">
                            <strong>Options:</strong>  
                            <ul class="mb-0">
                                <li><strong>Approve</strong> = confirm this schedule as is.</li>
                                <li><strong>Reschedule</strong> = assign a new schedule date.</li>
                            </ul>
                        </div>
                        <div class="mb-3 d-none" id="rescheduleBox{{ $booking->booking_id }}">
                            <label for="schedule{{ $booking->booking_id }}" class="form-label">New Schedule</label>
                            <input type="date" class="form-control" 
                                   name="schedule" 
                                   id="schedule{{ $booking->booking_id }}"
                                   min="{{ \Carbon\Carbon::parse($booking->schedule)->addDay()->toDateString() }}">
                            <small class="text-muted">
                                Earliest reschedule date is the day after the current schedule ({{ \Carbon\Carbon::parse($booking->schedule)->addDay()->format('M d, Y') }}).
                            </small>
                        </div>                        
                    @elseif ($booking->status === 'Approved')
                        <div class="alert alert-success">
                            This booking is <strong>Approved</strong>.  
                            You may now mark it as <strong>Completed</strong> or <strong>Failed</strong>.
                        </div>
                    @elseif ($booking->status === 'Completed')
                        <div class="alert alert-secondary">
                            This booking has been marked as <strong>Completed</strong>.
                        </div>
                    @elseif ($booking->status === 'Failed')
                        <div class="alert alert-danger">
                            This booking has been marked as <strong>Failed</strong>.
                        </div>
                    @endif
                </div>

                <div class="modal-footer">
                    @if ($booking->status === 'Pending')
                        <button type="submit" name="action" value="approve" class="btn btn-success">
                            Approve (Keep Current Date)
                        </button>
                        <button type="button" class="btn btn-warning"
                            onclick="document.getElementById('rescheduleBox{{ $booking->booking_id }}').classList.remove('d-none');
                                     document.getElementById('confirmReschedule{{ $booking->booking_id }}').classList.remove('d-none');
                                     this.classList.add('d-none');">
                            Reschedule
                        </button>
                        <button type="submit" name="action" value="reschedule" class="btn btn-warning d-none"
                            id="confirmReschedule{{ $booking->booking_id }}">
                            Confirm Reschedule
                        </button>
                    @elseif ($booking->status === 'Approved' || $booking->status === 'Rescheduled')
                        @php
                            $today = \Carbon\Carbon::today();
                            $scheduleDate = \Carbon\Carbon::parse($booking->schedule);
                        @endphp
                
                        @if($scheduleDate->lte($today))
                            <button type="submit" name="action" value="complete" class="btn btn-primary">
                                Mark as Completed
                            </button>
                            <button type="submit" name="action" value="failed" class="btn btn-danger">
                                Mark as Failed
                            </button>
                        @else
                            <div class="alert alert-warning w-100 text-center mb-0">
                                You can only mark this booking as <strong>Completed</strong> or <strong>Failed</strong> 
                                on or after <strong>{{ $scheduleDate->format('M d, Y') }}</strong>.
                            </div>
                        @endif
                    @else
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    @endif
                </div>                
            </form>
        </div>
    </div>
</div>
