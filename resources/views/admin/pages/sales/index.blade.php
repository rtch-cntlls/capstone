@extends('admin.layouts.admin')
@section('content')
@include('admin.pages.sales.includes.cards')
<div class="card mx-2 mb-4 p-4 shadow-sm" style="font-size:14px;">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <form method="GET" class="d-flex align-items-center">
            <input type="date" id="transaction_date" name="transaction_date" 
                   class="form-control form-control-sm border-primary"
                   value="{{ request('transaction_date') ?? now()->toDateString() }}"
                   onchange="this.form.submit()">
        </form>
    </div>
    @if ($sales->isEmpty())
        <div class="text-center py-5">
            <img src="{{ asset('images/empty.gif') }}" alt="No Sales" style="width: 180px;">
            <p class="text-muted mt-3 mb-0">No sale transactions found for this date.</p>
        </div>
    @else
        <div class="table-responsive table-wrapper">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light text-secondary">
                    <tr>
                        <th>Sale ID</th>
                        <th>Transaction</th>
                        <th>Amount Generated</th>
                        <th class="text-center">Transaction Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $startNumber = 1000;
                    @endphp
                    
                    @foreach ($sales as $sale)
                        <tr>
                            <td class="fw-medium">ST{{ $startNumber + $loop->iteration - 1 }}</td>
                            <td>
                                @if ($sale->sale_type === 'walk_in')
                                    <span class="badge bg-success">Walk-in</span>
                                @else
                                    <span class="badge bg-primary">Online Order</span>
                                @endif
                            </td>
                            <td class="text-success fw-bold">₱ {{ number_format($sale->grand_total, 2) }}</td>
                            <td class="text-center text-muted">{{ $sale->sale_date->format('M d, Y h:i A') }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-outline-primary btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#saleModal{{ $sale->sale_id }}">
                                    <i class="fas fa-eye"></i>
                                </button>
                                @include('admin.pages.sales.show')
                            </td>
                        </tr>
                    @endforeach                
                </tbody>
            </table>
        </div>
        <div class="p-3">
            {{ $sales->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
<script>
    function printSale(saleId) {
        const printContents = document.getElementById('printableSale' + saleId).innerHTML;
        const originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        window.location.reload();
    }
</script>
@endsection
