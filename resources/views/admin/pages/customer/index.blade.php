@extends('admin.layouts.admin')
@section('content')
@include('admin.pages.customer.includes.cards')
<div class="card mx-2 p-4 shadow-sm" style="font-size: 14px;">
    <div class="mb-2">
        @if (session('success-alert'))
            <x-alert type="success" :message="session('success-alert')" />
        @endif
        <div class="">
            <form method="GET" action="">
                <input type="search" name="search" value="" 
                       class="form-control inv-search search" 
                       placeholder="Search customer name" 
                       aria-label="Search">
            </form>                
        </div>
    </div>
    @if ($customers->isEmpty())
        <div class="text-center my-4">
            <img src="{{ asset('images/empty.gif') }}" alt="No Customers" style="width: 200px;">
            <p class="m-0">No Customers found</p>
        </div>
    @else
        <div class="table-responsive mt-3 table-wrapper">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($customers as $customer)
                        <tr>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <img src="{{ $customer->user->profile ?? asset('profile/customer.webp') }}" 
                                         alt="Profile" width="30" style="border-radius:50%;">
                                    {{ $customer->user->firstname }} {{ $customer->user->lastname }}
                                </div>
                            </td>
                            <td>{{ $customer->user->email }}</td>
                            <td>{{ $customer->phone ?? '---' }}</td>
                            <td>
                                @if($customer->addresses->isNotEmpty())
                                    {{ $customer->addresses->first()->street }}, 
                                    {{ $customer->addresses->first()->barangay }}, 
                                    {{ $customer->addresses->first()->city }}, 
                                    {{ $customer->addresses->first()->province }}
                                @else
                                    ---
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('admin.customer.show', $customer->customer_id) }}" 
                                   class="btn btn-sm btn-primary" 
                                   title="View Customer">
                                    <i class="fas fa-eye me-2"></i>View
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
