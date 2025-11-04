document.addEventListener('DOMContentLoaded', function () {
    const productContainer = document.getElementById('ajax-products');
    const selectedProducts = new Set();

    function syncSelected() {
        selectedProducts.clear();
        document.querySelectorAll('.product-checkbox:checked').forEach(cb => {
            selectedProducts.add(cb.value);
        });
    }

    function restoreSelected() {
        selectedProducts.forEach(id => {
            const checkbox = document.querySelector(`.product-checkbox[value="${id}"]`);
            if (checkbox) {
                checkbox.checked = true;
                checkbox.closest('.selectable-card')?.classList.add('selected');
            }
        });
    }

    function initSelectableCards() {
        const promoType = document.getElementById('promoType');
        const checkboxes = document.querySelectorAll('.product-checkbox');
        const cards = document.querySelectorAll('.selectable-card');

        function updateMode() {
            const type = promoType.value;
            checkboxes.forEach(cb => cb.checked = false);
            cards.forEach(card => card.classList.remove('selected'));

            if (type === 'single') {
                checkboxes.forEach(cb => {
                    cb.addEventListener('change', handleSingleSelect);
                });
            } else {
                checkboxes.forEach(cb => {
                    cb.removeEventListener('change', handleSingleSelect);
                });
            }
        }

        function handleSingleSelect(e) {
            if (e.target.checked) {
                checkboxes.forEach(cb => {
                    if (cb !== e.target) {
                        cb.checked = false;
                        cb.closest('.selectable-card').classList.remove('selected');
                    }
                });
                e.target.closest('.selectable-card').classList.add('selected');
            } else {
                e.target.closest('.selectable-card').classList.remove('selected');
            }
        }

        cards.forEach(card => {
            const checkbox = card.querySelector('.product-checkbox');
            card.addEventListener('click', function (e) {
                if (e.target !== checkbox) {
                    checkbox.checked = !checkbox.checked;
                    if (promoType.value === 'single') {
                        checkbox.dispatchEvent(new Event('change'));
                    } else {
                        card.classList.toggle('selected', checkbox.checked);
                    }
                    syncSelected();
                }
            });
        });

        checkboxes.forEach(cb => {
            cb.addEventListener('change', syncSelected);
        });

        promoType.addEventListener('change', updateMode);
        updateMode();
        restoreSelected();
    }

    document.addEventListener('click', function (e) {
        if (e.target.matches('.page-link')) {
            e.preventDefault();
            const url = e.target.href;

            fetch(url)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newContent = doc.querySelector('#ajax-products');
                    productContainer.innerHTML = newContent.innerHTML;
                    initSelectableCards(); 
                    restoreSelected();   
                })
                .catch(error => console.error('Pagination load failed:', error));
            }
        });
    initSelectableCards();
});