<div class="col-md-12">
    <div class="card mb-4 p-3">
        <h6 class="fw-bold">Recent Sold Items</h6>
        <div style="font-size: 15px;">
            @if ($recentSoldProducts->isEmpty())
                <div class="text-center my-2">
                    <img src="{{ asset('images/empty.gif') }}" alt="No Orders" style="width: 135px;">
                    <p class="m-0">No recent sold items</p>
                </div>
            @else
                <div class="table-responsive table-wrapper">
                    <table class="table table-sm table-hover align-middle">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th class="text-center">Price (₱)</th>
                                <th class="text-center">Number Sold</th>
                                <th class="text-end">Revenue</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentSoldProducts as $item)
                                <tr>
                                    <td class="d-flex align-items-center gap-2">
                                        <img src="{{ $item->product && $item->product->image ? asset($item->product->image) : asset('images/placeholder.png') }}" width="50" class="rounded">
                                       <div>
                                            <div class="fw-semibold">
                                                {{ $item->product->product_name}}
                                            </div>
                                            <small>{{ $item->product->category->name}}</small>
                                       </div>
                                    </td>
                                    <td class="text-center">₱{{ number_format($item->price, 2) }}</td>
                                    <td class="text-center">{{ $item->total_quantity }}</td>
                                    <td class="text-end">₱{{ number_format($item->total_revenue, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
</div>