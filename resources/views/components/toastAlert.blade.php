<script>
    @if(session('success'))
      Swal.fire({
        toast: true,
        position: 'bottom-end',
        icon: 'success',
        title: "{{ session('success') }}",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
      });
    @endif
  
    @if(session('error'))
      Swal.fire({
        toast: true,
        position: 'bottom-end',
        icon: 'error',
        title: "{{ session('error') }}",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true
      });
    @endif
</script>