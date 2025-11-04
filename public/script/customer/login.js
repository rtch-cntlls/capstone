document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const loginBtn = document.getElementById("authbtn");
    const loginText = document.getElementById("authtext");
    const loginSpinner = document.getElementById("authSpinner");

    form.addEventListener("submit", function () {
        loginBtn.disabled = true;
        loginSpinner.classList.remove("d-none");
        loginText.textContent = "";
    });
});