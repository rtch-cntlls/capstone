@extends('admin.layouts.admin')
@section('content')
@include('components.ModalAlertSuccess')
@include('components.ModalAlertError')
@include('components.ModalAlertWarning')
@include('admin.pages.services.create')
@include('admin.pages.services.includes.cards')
<div class="card p-4 mx-2 shadow-sm">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="fw-bold mb-0">Service List</h5>
        <form method="GET" action="" data-auto-search class="ms-auto">
            <input type="search" name="search" value="{{ request('search') }}"
                   class="form-control form-control-sm" 
                   placeholder="Search service name..." aria-label="Search">
        </form>     
    </div>
    @if (session('success-alert'))
        <x-alert type="success" :message="session('success-alert')" />
    @endif
    @if ($services->isEmpty())
        <div class="text-center my-5">
            <img src="{{ asset('images/empty.gif') }}" alt="No Services" style="width: 180px;">
            <h6 class="fw-bold mt-3">No services found</h6>
        </div>
    @else
        <div class="table-responsive table-wrapper">
            <table class="table table-hover align-middle text-center">
                <thead class="table-light">
                    <tr>
                        <th class="text-start">Service Name</th>
                        <th>Price</th>
                        <th>Duration</th>
                        <th>Status</th>
                        <th style="width: 160px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($services as $service)
                        <tr>
                            <td class="text-start" style="font-size:14px;">{{ $service->name }}</td>
                            <td>₱{{ number_format($service->price, 2) }}</td>
                            <td>{{ $service->duration ?? '---' }}</td>
                            <td>
                                <span class="badge {{ $service->status === 'Active' ? 'bg-success' : 'bg-danger' }}">
                                    {{ $service->status }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="#" class="btn btn-sm btn-outline-primary"
                                       data-bs-toggle="modal" 
                                       data-bs-target="#editServiceModal{{ $service->service_id }}">
                                        <i class="fa fa-edit me-1"></i>Edit
                                    </a>
                                    <a href="#" 
                                       class="btn btn-sm {{ $service->status === 'Active' ? 'btn-outline-danger' : 'btn-outline-success' }}" 
                                       data-bs-toggle="modal" 
                                       data-bs-target="#statusServiceModal{{ $service->service_id }}">
                                        {{ $service->status === 'Active' ? 'Deactivate' : 'Activate' }}
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @include('admin.pages.services.edit')
                        @include('admin.pages.services.status')
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
    <div class="mt-3">
        {{ $services->links('pagination::bootstrap-5') }}
    </div>
</div>
<script src="{{ asset('script/button.js')}}"></script>
@endsection
