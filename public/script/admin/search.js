document.addEventListener('DOMContentLoaded', function () {
    const searchForms = document.querySelectorAll('form[data-auto-search]');

    searchForms.forEach(form => {
        const searchInput = form.querySelector('input[type="search"]');
        if (!searchInput) return;

        let typingTimer;
        const delay = form.dataset.delay ? parseInt(form.dataset.delay) : 300;

        searchInput.addEventListener('keyup', function () {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(() => {
                form.submit();
            }, delay);
        });
    });
});
