document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form.create');
    form.addEventListener('submit', (e) => {
        form.querySelectorAll('input[type="hidden"][name="product_ids[]"]').forEach(el => el.remove());
        const checkedInputs = document.querySelectorAll('.product-checkbox:checked');

        if (checkedInputs.length === 0) {
            e.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: 'Missing Selection',
                text: 'Please select at least one product.'
            });
            return false;
        }
        checkedInputs.forEach(chk => {
            const hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'product_ids[]';
            hidden.value = chk.value || chk.dataset.productId;
            form.appendChild(hidden);
        });
    });
});