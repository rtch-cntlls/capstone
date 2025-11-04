@extends('client.layouts.clientNoFooter')
@section('content')
<div class="container">
    <a href="{{ route('shop-services.index') }}" class="text-decoration-none">
        <i class="fas fa-arrow-left me-1"></i> Back to Services
    </a>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="card p-3 shadow-sm">
                <h5 class="fw-bold mb-3"><i class="fas fa-user me-2"></i>Personal Details</h5>
                <div class="mb-3">
                    <label class="small form-label">First Name</label>
                    <input type="text" class="form-control" value="{{ Auth::user()->firstname }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="small form-label">Last Name</label>
                    <input type="text" class="form-control" value="{{ Auth::user()->lastname }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="small form-label">Email Address</label>
                    <input type="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow-sm p-3 mb-3">
                <h5 class="fw-bold mb-3"><i class="fas fa-gear me-2"></i>Service Details</h5>
                <div class="mb-3">
                    <label class="small form-label">Service Type</label>
                    <input type="text" class="form-control" value="{{ $service->name }}" readonly>
                </div>
                <div class="mb-3">
                    <label class="small form-label">Price</label>
                    <input type="text" class="form-control text-danger fw-bold" 
                           value="₱{{ number_format($service->price, 2) }}" readonly>
                </div>
                @if($service->duration)
                    <div class="mb-3">
                        <label class="small form-label">Service Duration</label>
                        <input type="text" class="form-control" value="{{ $service->duration }}" readonly>
                    </div>
                @endif
                @if($service->description)
                    <div class="mb-3">
                        <label class="small form-label">Description</label>
                        <textarea class="form-control" rows="3" readonly>{{ $service->description }}</textarea>
                    </div>
                @endif
            </div>
            <div class="card shadow-sm p-3">
                <h5 class="fw-bold mb-3"><i class="fas fa-calendar-alt me-2"></i>Schedule & Notes</h5>
                <form action="{{ route('shop-services.StoreBooking', $service->service_id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="small form-label">Select Date</label>
                        <input type="date" name="schedule" class="form-control @error('schedule') is-invalid @enderror" 
                               value="{{ old('schedule') }}"
                               min="{{ now()->addDay()->format('Y-m-d') }}">
                        @error('schedule')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="small form-label">Additional Notes (Optional)</label>
                        <textarea name="notes" class="form-control" rows="4" placeholder="Add any special instructions..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Confirm Booking</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
