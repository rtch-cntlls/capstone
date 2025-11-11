@extends('admin.layouts.admin')
@section('content')
@include('admin.pages.product.add-discount')
@include('admin.pages.product.edit-price')
@include('components.ModalAlertSuccess')
@include('components.ModalAlertError')
@include('components.AdminLoader')
<div class="mt-2 mb-2">
    <a href="{{ url()->previous() }}" class="text-decoration-none small text-muted">
        <i class="fas fa-arrow-left me-1"></i> Back
    </a>
</div>
    <div class="row p-2 align-items-center">
        <div class="col-md-6">
            <h5 class="fw-bold m-0">Product details</h5>
        </div>

    
        <div class="col-md-6 text-md-end text-start mt-2 mt-md-0">
            <button class="btn btn-primary" style="font-size: 11px;" data-bs-toggle="modal" data-bs-target="#addDiscountModal">
                <i class="fa fa-plus me-1"></i> <span class="fw-bold">Apply Discount</span>
            </button>    
            <button class="btn btn-success" style="font-size: 11px;" data-bs-toggle="modal" data-bs-target="#editPricingModal">
                <i class="fa fa-pen me-1"></i> <span class="fw-bold">Edit Pricing</span>
            </button>                  
        </div>
    </div>  
    <div class="row p-3">
        <div class="col-md-3">
            <div class="card p-3 text-center">
                <img src="{{ $product->image ? asset($product->image) : asset('images/placeholder.png') }}" 
                     class="card-img-top image">
                <div class="card-body">
                    <h6 class="card-title">{{ $product->product_name }}</h6>
                </div>
            </div>            
        </div>
        <div class="col-md-9"> 
            <div class="p-3 position-relative">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-unstyled position-relative timeline m-2">
                            @include('admin.pages.product.includes.product-info')
                            @include('admin.pages.product.includes.specs')
                            @include('admin.pages.product.includes.discount')
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <ul class="list-unstyled position-relative timeline m-2">
                            @include('admin.pages.product.includes.pricing')
                            @include('admin.pages.product.includes.profit')
                            @include('admin.pages.product.includes.sales')                  
                        </ul>
                    </div>
                </div>
                <div class="text-end d-flex justify-content-end gap-2">
                    <button class="btn btn-outline-secondary fw-bold" type="button" data-bs-toggle="collapse" data-bs-target="#adminProductComments">
                        <i class="fas fa-comments me-2"></i>View comments/ratings
                    </button>
                    <a href="{{ route('admin.inventory.show', ['id' => $product->inventory->inventory_id]) }}" 
                    class="btn btn-outline-primary fw-bold"><i class="fas fa-eye me-2"></i>View inventory details</a>
                </div>
            </div>
        </div>
    </div>

    @php $reviews = $product->reviews ?? collect(); @endphp
    <div class="row p-3" id="adminCommentsSection">
        <div class="col-12">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="fw-bold mb-0">Comments/Ratings ({{ $reviews->count() }})</h6>
                    </div>
    
                    <div class="collapse" id="adminProductComments">
                        @forelse($reviews as $rev)
                            <div class="card mb-2 shadow-sm">
                                <div class="card-body p-3">
                                    <div class="d-flex align-items-center mb-2">
                                        <div class="fw-semibold">{{ $rev->customer->user->firstname ?? 'Customer' }}</div>
                                        <div class="ms-auto text-warning">
                                            {!! str_repeat('<i class="fas fa-star"></i>', (int)$rev->rating) !!}
                                            {!! str_repeat('<i class="far fa-star"></i>', 5-(int)$rev->rating) !!}
                                        </div>
                                    </div>
                                    @if($rev->comment)
                                        <p class="mb-2 small text-muted">{{ $rev->comment }}</p>
                                    @endif
    
                                    @if($rev->replies && $rev->replies->count())
                                        <div class="ms-3 mb-2">
                                            @foreach($rev->replies as $rep)
                                                <div class="bg-light p-2 rounded mb-1 small"><strong>Admin:</strong> {{ $rep->comment }}</div>
                                            @endforeach
                                        </div>
                                    @endif
    
                                    <form method="POST" action="{{ route('admin.reviews.reply', $rev->id) }}" class="mt-2">
                                        @csrf
                                        <div class="input-group input-group-sm">
                                            <input type="text" name="comment" class="form-control" placeholder="Reply as admin..." required>
                                            <button class="btn btn-primary">Reply</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="text-center text-muted small py-3">No comments yet.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<script>
    document.addEventListener('DOMContentLoaded', function(){
        const toggleBtn = document.querySelector('[data-bs-target="#adminProductComments"]');
        const comments = document.getElementById('adminProductComments');
        const section = document.getElementById('adminCommentsSection');
        function scrollToComments(){ if(section){ section.scrollIntoView({behavior:'smooth', block:'start'}); } }
        if (toggleBtn) toggleBtn.addEventListener('click', ()=> setTimeout(scrollToComments, 50));
        if (comments) comments.addEventListener('shown.bs.collapse', scrollToComments);
    });
</script>
@endsection