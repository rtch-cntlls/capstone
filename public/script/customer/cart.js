// function updateOrderSummary() {
//     const summaryDiv = document.getElementById('order-summary');
//     const totalDiv = document.getElementById('summary-total');
//     const checkoutBtn = document.getElementById('checkout-btn');
//     const emptyDiv = document.getElementById('empty');

//     const selectedRows = document.querySelectorAll('.product-checkbox:checked');
    
//     if(selectedRows.length === 0) {
//         summaryDiv.innerHTML = '';
//         totalDiv.textContent = '';
//         checkoutBtn.disabled = true;
//         emptyDiv.style.display = 'block';
//         return;
//     }

//     emptyDiv.style.display = 'none';

//     let html = '<ul class="list-group">';
//     let total = 0;

//     selectedRows.forEach(cb => {
//         const row = cb.closest('.product-row');
//         const name = row.dataset.name;
//         const qty = parseInt(row.dataset.quantity);
//         const rowTotal = parseFloat(row.dataset.total.replace(/,/g, ''));
//         total += rowTotal;
//         html += `<li class="list-group-item d-flex justify-content-between align-items-center" style="height:80px;">
//                     ${name}
//                     <span class="fw-bold text-danger">₱${rowTotal.toLocaleString('en-PH', {minimumFractionDigits: 2})}</span>
//                 </li>`;
//     });
//     html += '</ul>';

//     summaryDiv.innerHTML = html;
//     totalDiv.textContent = 'Subtotal: ₱' + total.toLocaleString('en-PH', {minimumFractionDigits: 2});
//     checkoutBtn.disabled = false;
// }

// document.querySelectorAll('.product-row').forEach(row => {
//     const checkbox = row.querySelector('.product-checkbox');

//     row.addEventListener('click', function(e) {
//         if(e.target.tagName === 'INPUT' || e.target.closest('form')) return;
//         checkbox.checked = !checkbox.checked;
//         updateOrderSummary();
//     });

//     checkbox.addEventListener('change', updateOrderSummary);
// });

// document.getElementById('checkout-btn').addEventListener('click', function() {
//     const selectedIds = Array.from(document.querySelectorAll('.product-checkbox:checked'))
//                              .map(cb => cb.value);
//     if(selectedIds.length === 0) return;
//     window.location.href = "{{ route('checkout') }}?products=" + selectedIds.join(',');
// });