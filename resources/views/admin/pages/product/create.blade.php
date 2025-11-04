@extends('admin.layouts.admin')
@section('content')
<div class="mt-2 mb-2">
    <a href="{{ url()->previous() }}" class="text-decoration-none small text-muted">
        <i class="fas fa-arrow-left me-1"></i> Back
    </a>
</div>
<div class="p-2 create">
    @if (session('success_redirect'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({icon: 'success',title: 'Success',
                    text: {!! json_encode(session('success_redirect')) !!}, confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "{{ route('admin.product.index') }}";
                    }
                });
            });
        </script>
    @endif
    @include('admin.pages.product.form.create-product')
    <div id="formLoader" class="overlay-loader d-none">
        <div class="spinner"></div>
        <p class="mt-3 fw-bold text-white">Publishing Product...</p>
    </div>
    <script src="{{ asset('script/admin/product-loader.js')}}"></script>
</div>
@endsection