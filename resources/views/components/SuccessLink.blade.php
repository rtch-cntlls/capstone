@if (session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                @if(session('force_logout'))
                window.location.href = "{{ route('admin.logout') }}";
                @endif
            }
        });
    </script>
 @endif