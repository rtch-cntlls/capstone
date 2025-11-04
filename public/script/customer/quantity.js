const qtyInput  = document.getElementById('quantity');
const qtyCart   = document.getElementById('quantity_cart');
const qtyBuy    = document.getElementById('quantity_buy');
const increase  = document.getElementById('increase');
const decrease  = document.getElementById('decrease');

const maxStock = parseInt(qtyInput.dataset.stock);

function syncQty() {
    qtyCart.value = qtyInput.value;
    qtyBuy.value  = qtyInput.value;
}
syncQty();

qtyInput.addEventListener('input', syncQty);

increase.addEventListener('click', () => {
    let current = parseInt(qtyInput.value);
    if (current < maxStock) {
        qtyInput.value = current + 1;
        syncQty();
    }
});

decrease.addEventListener('click', () => {
    let current = parseInt(qtyInput.value);
    if (current > 1) {
        qtyInput.value = current - 1;
        syncQty();
    }
});
