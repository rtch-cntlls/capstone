@extends('admin.layouts.admin')
@section('content')
@include('components.ModalAlertSuccess')
@include('components.ModalAlertError')
<div class="mt-3 p-2">
    @include('admin.pages.promo.includes.cards')
    <div class="mt-3">
        @if ($promo->isEmpty())
            <div class="text-center my-5">
                <img src="{{ asset('storage/images/empty.gif') }}" alt="No Products" style="width: 180px;">
                <p class="text-muted mt-3 mb-0">No promotions found.</p>
                <a href="{{ route('admin.promo.create') }}" class="btn btn-outline-primary mt-2">
                    <i class="fa fa-plus me-1"></i> Create Promo
                </a>
            </div>
        @else
            <div class="row g-3">
                @foreach ($promo as $promos)
                    <div class="col-12 col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body d-flex flex-column">
                                <h6 class="mb-2">{{ $promos->title }}</h6>
                                <div class="mb-3">
                                    <span class="badge bg-primary me-1">
                                        {{ intval($promos->discount_percent) }}% OFF
                                    </span>
                                    <span class="badge {{ $promos->status === 'Active' ? 'bg-success' : ($promos->status === 'Upcoming' ? 'bg-info' : 'bg-secondary') }}">
                                        {{ ucfirst($promos->status) }}
                                    </span>
                                    <div class="text-muted small mt-1">
                                        <i class="fa fa-calendar-alt me-1"></i>
                                        {{ $promos->start_date ? date('M d, Y', strtotime($promos->start_date)) : '—' }} 
                                        → 
                                        {{ $promos->expiry_date ? date('M d, Y', strtotime($promos->expiry_date)) : '—' }}
                                    </div>
                                </div>
                                <div class="flex-grow-1"></div>
                                <div class="d-grid mt-2">
                                    @if ($promos->status === 'Expired')
                                        <button class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#reactivateModal{{ $promos->id }}">
                                            <i class="fa fa-redo me-1"></i> Reactivate
                                        </button>
                                        <div class="modal fade" id="reactivateModal{{ $promos->id }}" tabindex="-1" aria-labelledby="reactivateModalLabel{{ $promos->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form method="POST" action="{{ route('admin.promo.reactivate', $promos->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="reactivateModalLabel{{ $promos->id }}">Reactivate Promo</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="start_date_{{ $promos->id }}" class="form-label">Start Date</label>
                                                                <input type="date" class="form-control" name="start_date" id="start_date_{{ $promos->id }}" value="{{ now()->toDateString() }}" required>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="expiry_date_{{ $promos->id }}" class="form-label">Expiry Date</label>
                                                                <input type="date" class="form-control" name="expiry_date" id="expiry_date_{{ $promos->id }}" value="{{ now()->addDays(7)->toDateString() }}" required>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">Reactivate</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    @else
                                    @include('admin.pages.promo.includes.view-product', ['promos' => $promos])
                                    <button class="btn btn-sm btn-outline-primary" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#productsModal{{ $promos->discount_id }}">
                                        <i class="fa fa-box me-1"></i> View Products
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                   
                @endforeach
            </div>
            <div class="mt-4">
                {{ $promo->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection
