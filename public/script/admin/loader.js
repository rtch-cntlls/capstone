document.addEventListener("DOMContentLoaded", function () {
    const loader = document.getElementById("loaderOverlay");
    if (!loader) return;

    function showLoader() {
        loader.classList.remove("d-none");
    }

    function hideLoader() {
        loader.classList.add("d-none");
    }

    document.querySelectorAll("#sidebarWrapper a").forEach(link => {
        link.addEventListener("click", function (e) {
            const href = this.getAttribute("href");

            if (!href || href === "#" || href.startsWith("javascript:") || this.hasAttribute("data-bs-toggle")) return;

            showLoader();
        });
    });
});
