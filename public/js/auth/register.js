function setConfirmPasswordAvailability() {
    let passwordInput = document.querySelector('.auth-page-sign-up-form input#password');
    let confirmPasswordInput = document.querySelector('.auth-page-sign-up-form input#password-confirm');

    if (confirmPasswordInput && passwordInput) {
        if (passwordInput.value.length > 0) {
            confirmPasswordInput.removeAttribute('disabled');
        } else {
            confirmPasswordInput.setAttribute('disabled', 'true');
        }
    }
}

document.addEventListener("DOMContentLoaded", () => {
    setConfirmPasswordAvailability();

    document.querySelector('.auth-page-sign-up-form input#password').addEventListener('input', () => {
        setConfirmPasswordAvailability();
    });
});
