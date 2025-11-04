document.addEventListener('DOMContentLoaded', function () {
    const pickUpRadio = document.getElementById('pick_up');
    const deliveryRadio = document.getElementById('delivery');
    const payLaterCheckbox = document.getElementById('payLater');
    const paymentOptions = document.querySelectorAll('input[name="payment_method"]');

    function togglePaymentMethods() {
        if (pickUpRadio.checked && payLaterCheckbox.checked) {
            paymentOptions.forEach(input => input.disabled = true);
            document.querySelectorAll('.payment-option').forEach(card => card.classList.add('disabled', 'opacity-50'));
            paymentOptions.forEach(input => input.checked = false);
        } else {
            paymentOptions.forEach(input => input.disabled = false);
            document.querySelectorAll('.payment-option').forEach(card => card.classList.remove('disabled', 'opacity-50'));
        }
    }

    pickUpRadio.addEventListener('change', togglePaymentMethods);
    deliveryRadio.addEventListener('change', togglePaymentMethods);
    payLaterCheckbox.addEventListener('change', togglePaymentMethods);

    togglePaymentMethods();
});