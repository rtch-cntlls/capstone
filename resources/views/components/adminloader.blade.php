
<div id="loaderOverlay" class="loader-overlay d-none" role="status" aria-live="polite" aria-label="Loading">
    <p class="loader-subtitle">Loading, please wait...</p>
    <div class="spinner">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>
<script src="{{ asset('script/admin/loader.js') }}"></script>

<style>
.loader-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.99);
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    z-index: 2000;
    transition: opacity 0.3s ease, visibility 0.3s ease;
}
.loader-overlay.d-none {
    opacity: 0;
    visibility: hidden;
}
.loader-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #007bff;
    margin-bottom: 0.2rem;
}
.loader-title span {
    color: #212529;
}
.loader-subtitle {
    color: #6c757d;
    font-size: 0.875rem;
}
.spinner {
    display: flex;
    gap: 8px;
    margin-top: 15px;
}
.spinner div {
    width: 12px;
    height: 12px;
    background-color: #007bff;
    border-radius: 50%;
    animation: bounce 0.6s infinite alternate;
}
.spinner div:nth-child(2) {
    animation-delay: 0.2s;
}
.spinner div:nth-child(3) {
    animation-delay: 0.4s;
}
@keyframes bounce {
    0% { transform: translateY(0); }
    50% { transform: translateY(-15px); }
    100% { transform: translateY(0); }
}
@media (prefers-reduced-motion: reduce) {
    .spinner div {
        animation: none;
    }
}
</style>
