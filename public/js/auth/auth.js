const loginInputs = document.querySelectorAll('.auth-page-login-form input#email, .auth-page-login-form input#password');

function checkingFields() {
    let filledAllInputs = true;

    loginInputs.forEach(input => {
        if (input.value.length <= 0) {
            filledAllInputs = false;
        }
    });

    return filledAllInputs;
}

function setLoginButtonAvailability() {
    let loginButton = document.querySelector('#loginButton');
    if (loginButton) {
        if (checkingFields()) {
            loginButton.removeAttribute('disabled');
        } else {
            loginButton.setAttribute('disabled', 'true');
        }
    }
}

loginInputs && loginInputs.length > 0 && loginInputs.forEach(element => {
    element.addEventListener('input', () => {
        setLoginButtonAvailability();
    });
});

document.addEventListener("DOMContentLoaded", () => {
    setLoginButtonAvailability();
});
