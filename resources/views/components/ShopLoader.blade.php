<style>
.loader-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: white;
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 9999;
}

.wave-loader {
    display: flex;
    align-items: flex-end;
    gap: 4px;
}
.wave-loader div {
    width: 6px;
    height: 20px;
    background: #007bff; 
    animation: wave 1.2s infinite ease-in-out;
}
.wave-loader div:nth-child(1) { animation-delay: 0s; }
.wave-loader div:nth-child(2) { animation-delay: 0.1s; }
.wave-loader div:nth-child(3) { animation-delay: 0.2s; }
.wave-loader div:nth-child(4) { animation-delay: 0.3s; }
.wave-loader div:nth-child(5) { animation-delay: 0.4s; }

@keyframes wave {
    0%, 40%, 100% { transform: scaleY(0.4); }
    20% { transform: scaleY(1); }
}
</style>
    <div id="loaderOverlay" class="loader-overlay d-none">
        <div class="wave-loader">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
<script src="{{ asset('script/loader/shop.js')}}"></script>
