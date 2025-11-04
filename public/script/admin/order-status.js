document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.status-radio').forEach(radio => {
        radio.addEventListener('change', function() {
            const orderId = this.id.split('_')[1];
            const deliveryWrapper = document.getElementById('deliveryDateWrapper_' + orderId);
            const shippedWrapper = document.getElementById('shippedWrapper_' + orderId);

            if (deliveryWrapper) {
                if (this.value === 'out_for_delivery') {
                    deliveryWrapper.classList.remove('d-none');
                } else {
                    deliveryWrapper.classList.add('d-none');
                }
            }

            if (shippedWrapper) {
                if (this.value === 'shipped') {
                    shippedWrapper.classList.remove('d-none');
                } else {
                    shippedWrapper.classList.add('d-none');
                }
            }
        });
    });

    flatpickr(".flatpickr-date", {
        dateFormat: "Y-m-d",
        minDate: new Date().fp_incr(1),
        defaultDate: null,
        allowInput: false,
        altInput: true,
        altFormat: "F j, Y",
    });
});
