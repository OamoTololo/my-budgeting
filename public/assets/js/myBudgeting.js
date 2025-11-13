document.addEventListener("DOMContentLoaded", function () {
    const togglePassword = document.querySelector("#togglePassword");
    const passwordInput = document.querySelector("#password");
    const spinnerOverlay = document.querySelector("#spinnerOverlay");
    const loginForm = document.querySelector("#loginForm");

    // Toggle password visibility
    if (togglePassword) {
        togglePassword.addEventListener("click", function () {
            const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
            passwordInput.setAttribute("type", type);
            this.classList.toggle("fa-eye-slash");
        });
    }

    // Show spinner on form submit
    if (loginForm) {
        loginForm.addEventListener("submit", function () {
            spinnerOverlay.style.display = "flex";
        });
    }
});
