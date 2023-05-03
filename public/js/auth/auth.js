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

    loginInputs && loginInputs.length > 0 && loginInputs.forEach(element => {
        element.addEventListener('input', () => {
            setLoginButtonAvailability();
        });
    });
});

function validateLogin(event) {
    if (!checkNotEmpty()) {
        event.preventDefault()
        return false;
    }

    if (!checkValidEmail()) {
        event.preventDefault()
        return false;
    }

    if (!checkCredential()) {
        event.preventDefault()
        return false;
    }
}

function checkNotEmpty() {
    document.querySelectorAll('.test-login-errors > p').forEach(el => {
       el.classList.add('hidden')
    });

    const login = document.querySelector('input#email')
    const password = document.querySelector('input#password')

    if (login.value === '' || password.value === '') {
        setTimeout(() => {
            document.querySelector('.test-login-errors > p:nth-of-type(1)').classList.remove('hidden')
        }, 4000);

        return false
    }

    return true
}

function checkValidEmail() {
    let result = !!String(document.querySelector('input#email').value)
        .toLowerCase()
        .match(
            /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );

    if (!result) {
        setTimeout(() => {
            document.querySelector('.test-login-errors > p:nth-of-type(2)').classList.remove('hidden')
        }, 4000);

        return false;
    }

    return true;
}

function checkCredential() {
    let response = sendRequest(
        'POST',
        '/test/checkCredentials',
        {
            "email": document.querySelector('input#email').value,
            "password": document.querySelector('input#password').value
        }
    );

    if (!response.success) {
        setTimeout(() => {
            document.querySelector('.test-login-errors > p:nth-of-type(2)').classList.remove('hidden')
        }, 4000);

        return false
    }

    return true
}

