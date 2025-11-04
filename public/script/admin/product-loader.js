document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form[action*="admin/product/store"]');
    const loader = document.getElementById('formLoader');

    if (form && loader) {
        form.addEventListener('submit', () => {
            loader.classList.remove('d-none');
            loader.classList.add('active');

            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i> Publishing...';
            }
        });
    }
});
