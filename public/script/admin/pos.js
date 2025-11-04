window.addEventListener('DOMContentLoaded', function () {
    const totalElement = document.querySelector('[data-order-total]');
    window.orderTotal = parseFloat(totalElement?.dataset.orderTotal || 0);

    const amountInput = document.getElementById('amount_paid');
    const changeInput = document.getElementById('change');
    const changeDisplay = document.getElementById('change_display');

    window.pressNum = function (num) {
        if (!amountInput) return;
        amountInput.value = amountInput.value + num;
        computeChange();
    };

    window.clearInput = function () {
        if (!amountInput || !changeDisplay) return;
        amountInput.value = '';
        changeDisplay.innerHTML = '';
    };

    window.computeChange = function () {
        const total = window.orderTotal || 0;
        const paid = parseFloat(amountInput.value) || 0;
        const change = paid - total;

        if (changeInput) {
            changeInput.value = change >= 0 ? change.toFixed(2) : 0;
        }

        if (paid > 0) {
            if (change >= 0) {
                changeDisplay.innerHTML =
                    `Change: <span class="text-success">₱${change.toFixed(2)}</span>`;
            } else {
                changeDisplay.innerHTML =
                    `<span class="text-danger">Insufficient Amount</span>`;
            }
        } else {
            changeDisplay.innerHTML = '';
        }
    };
});
