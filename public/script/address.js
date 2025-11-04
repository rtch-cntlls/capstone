document.addEventListener('DOMContentLoaded', function () {
    const provinceSelect = document.getElementById('provinceSelect');
    const citySelect = document.getElementById('citySelect');
    const barangaySelect = document.getElementById('barangaySelect');

    // Get preselected values from data attributes
    const preselectedProvince = provinceSelect?.dataset.value || '';
    const preselectedCity = citySelect?.dataset.value || '';
    const preselectedBarangay = barangaySelect?.dataset.value || '';

    // Fetch all provinces
    if (provinceSelect) {
        fetch('https://psgc.gitlab.io/api/provinces/')
            .then(res => res.json())
            .then(data => {
                data.sort((a, b) => a.name.localeCompare(b.name))
                    .forEach(province => {
                        let opt = document.createElement('option');
                        opt.value = province.name;
                        opt.textContent = province.name;
                        opt.dataset.code = province.code;
                        if (province.name === preselectedProvince) opt.selected = true;
                        provinceSelect.appendChild(opt);
                    });

                // Populate cities if province already selected
                if (provinceSelect.value) populateCities(provinceSelect.value);
            });

        provinceSelect.addEventListener('change', function () {
            populateCities(this.value);
        });
    }

    if (citySelect) {
        citySelect.addEventListener('change', function () {
            populateBarangays(this.value);
        });
    }

    function populateCities(provinceName) {
        citySelect.innerHTML = '<option value="">Select City</option>';
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

        let provinceOption = Array.from(provinceSelect.options).find(o => o.value === provinceName);
        let provinceCode = provinceOption?.dataset.code;
        if (!provinceCode) return;

        fetch(`https://psgc.gitlab.io/api/provinces/${provinceCode}/cities-municipalities/`)
            .then(res => res.json())
            .then(data => {
                data.sort((a, b) => a.name.localeCompare(b.name))
                    .forEach(city => {
                        let opt = document.createElement('option');
                        opt.value = city.name;
                        opt.textContent = city.name;
                        opt.dataset.code = city.code;
                        if (city.name === preselectedCity) opt.selected = true;
                        citySelect.appendChild(opt);
                    });

                if (citySelect.value) populateBarangays(citySelect.value);
            });
    }

    function populateBarangays(cityName) {
        barangaySelect.innerHTML = '<option value="">Select Barangay</option>';

        let cityOption = Array.from(citySelect.options).find(o => o.value === cityName);
        let cityCode = cityOption?.dataset.code;
        if (!cityCode) return;

        fetch(`https://psgc.gitlab.io/api/cities-municipalities/${cityCode}/barangays/`)
            .then(res => res.json())
            .then(data => {
                data.sort((a, b) => a.name.localeCompare(b.name))
                    .forEach(barangay => {
                        let opt = document.createElement('option');
                        opt.value = barangay.name;
                        opt.textContent = barangay.name;
                        if (barangay.name === preselectedBarangay) opt.selected = true;
                        barangaySelect.appendChild(opt);
                    });
            });
    }
});
