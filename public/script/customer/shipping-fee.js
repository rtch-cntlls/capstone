document.addEventListener('DOMContentLoaded', function () {
    const deliveryRadio = document.getElementById('delivery');
    const pickUpRadio = document.getElementById('pick_up');
    const deliveryFeeSection = document.getElementById('deliveryFeeSection');
    const payLaterSection = document.getElementById('payLaterSection');
    const payLaterCheckbox = document.getElementById('payLater');
    const provinceSelect = document.getElementById('provinceSelect');
    const citySelect = document.getElementById('citySelect');
    const deliveryFeeInput = document.getElementById('deliveryFeeInput');
    const deliveryFeeText = document.getElementById('deliveryFeeText');
    const paymentOptions = document.querySelectorAll('input[name="payment_method"]');


    const shippingFees = window.shopData.shippingFees;
    const shopServiceArea = window.shopData.serviceArea;
    const shopProvince = window.shopData.province;
    const shopCity = window.shopData.city;
    const totalWeightKg = window.totalWeightKg || 0;
    const JTRates = window.JTRates || null;

    const formatCurrency = v => '₱' + parseFloat(v || 0).toFixed(2);

    function getRegionByProvince(province) {
        province = province.toLowerCase();
        const luzon = ['ilocos norte','ilocos sur','la union','pangasinan','batanes','cagayan','isabela',
        'nueva vizcaya','quirino','aurora','bataan','bulacan','nueva ecija','pampanga','tarlac','zambales',
        'batangas','cavite','laguna','quezon','rizal','marinduque','occidental mindoro','oriental mindoro','palawan',
        'romblon','albay','camarines norte','camarines sur','catanduanes','masbate','sorsogon','abra','apayao','benguet',
        'ifugao','kalinga','mountain province','metro manila','manila','makati','pasig','taguig','quezon city','caloocan',
        'las piñas','malabon','mandaluyong','marikina','muntinlupa','navotas','parañaque','pasay','san juan','valenzuela','pateros'];
        const visayas = ['aklan','antique','capiz','guimaras','iloilo','negros occidental','bohol','cebu',
        'negros oriental','siquijor','biliran','eastern samar','leyte','northern samar','samar','southern leyte','western samar'];
        const mindanao = ['zamboanga del norte','zamboanga del sur','zamboanga sibugay','bukidnon','camiguin',
        'lanao del norte','misamis occidental','misamis oriental','davao de oro','compostela valley','davao del norte',
        'davao del sur','davao occidental','davao oriental','cotabato','north cotabato','south cotabato','sultan kudarat',
        'saranggani','agusan del norte','agusan del sur','dinagat islands','surigao del norte','surigao del sur','basilan',
        'lanao del sur','maguindanao','maguindanao del norte','maguindanao del south','sulu','tawi-tawi'];

        if (luzon.some(p => province.includes(p))) return 'luzon';
        if (visayas.some(p => province.includes(p))) return 'visayas';
        if (mindanao.some(p => province.includes(p))) return 'mindanao';
        return null;
    }

    function isManila(province, city) {
        const metro = ['metro manila','manila','makati','pasig','taguig','quezon city','caloocan','las piñas','malabon','mandaluyong','marikina','muntinlupa','navotas','parañaque','pasay','san juan','valenzuela','pateros'];
        const p = (province||'').toLowerCase();
        const c = (city||'').toLowerCase();
        return metro.some(m => p.includes(m) || c.includes(m));
    }

    function isIslandProvince(province) {
        const islands = ['palawan','romblon','catanduanes','marinduque','batanes','siquijor','dinagat islands','camiguin','basilan','sulu','tawi-tawi','guimaras'];
        const p = (province||'').toLowerCase();
        return islands.some(m => p.includes(m));
    }

    function calcJTFee(weightKg, province, city) {
        if (!JTRates) return 0;
        let column = 'Luzon';
        if (isManila(province, city)) column = 'Manila';
        else if (isIslandProvince(province)) column = 'Island';
        else {
            const region = getRegionByProvince(province);
            if (region === 'visayas') column = 'Visayas';
            else if (region === 'mindanao') column = 'Mindanao';
            else column = 'Luzon';
        }

        const brackets = JTRates.brackets;
        for (const b of brackets) {
            if (weightKg >= b.min && weightKg <= b.max) {
                return JTRates.rates[column][b.key] || 0;
            }
        }

        const lastKey = brackets[brackets.length - 1].key;
        return JTRates.rates[column][lastKey] || 0;
    }

    function updateDeliveryFee() {
        const province = (provinceSelect?.value || '').toLowerCase();
        const city = (citySelect?.value || '').toLowerCase();
        let fee = 0;

        if (JTRates && totalWeightKg > 0 && deliveryRadio.checked) {
            fee = calcJTFee(totalWeightKg, province, city);
        } else {
            if (city && province && city.includes(shopCity) && province.includes(shopProvince)) {
                fee = shippingFees.local;
            } else if (province && province.includes(shopProvince)) {
                fee = shippingFees.province;
            } else if (shopServiceArea === 'local') {
                fee = shippingFees.local;
            } else if (shopServiceArea === 'province') {
                fee = shippingFees.province;
            } else if (['luzon','visayas','mindanao'].includes(shopServiceArea)) {
                fee = shippingFees[shopServiceArea];
            } else {
                const region = getRegionByProvince(province);
                if (region && shippingFees[region] !== undefined) fee = shippingFees[region];
            }
        }

        deliveryFeeInput.value = fee;
        deliveryFeeText.textContent = formatCurrency(fee);
    }

    function toggleDeliverySection() {
        if (deliveryRadio.checked) {
            deliveryFeeSection.classList.remove('d-none');
            payLaterSection.classList.add('d-none');
            payLaterCheckbox.checked = false;
            updateDeliveryFee();
        } else if (pickUpRadio.checked) {
            deliveryFeeSection.classList.add('d-none');
            payLaterSection.classList.remove('d-none');
        }
    }

    function togglePaymentMethods() {
        if (pickUpRadio.checked && payLaterCheckbox.checked) {
            paymentOptions.forEach(input => input.disabled = true);
            document.querySelectorAll('.payment-option').forEach(card => card.classList.add('disabled','opacity-50'));
            paymentOptions.forEach(input => input.checked = false);
        } else {
            paymentOptions.forEach(input => input.disabled = false);
            document.querySelectorAll('.payment-option').forEach(card => card.classList.remove('disabled','opacity-50'));
        }
    }

    deliveryRadio.addEventListener('change', toggleDeliverySection);
    pickUpRadio.addEventListener('change', toggleDeliverySection);
    provinceSelect?.addEventListener('change', updateDeliveryFee);
    citySelect?.addEventListener('change', updateDeliveryFee);

    pickUpRadio.addEventListener('change', togglePaymentMethods);
    deliveryRadio.addEventListener('change', togglePaymentMethods);
    payLaterCheckbox.addEventListener('change', togglePaymentMethods);


    if (provinceSelect?.value) updateDeliveryFee();
    toggleDeliverySection();
    togglePaymentMethods();
});
