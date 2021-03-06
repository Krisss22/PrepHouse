function sendRequest(method = 'GET', url, data = {}, async = false, successCallbackFunction = null, errorCallbackFunction = null) {
    let xhr = new XMLHttpRequest();
    let resultData = null;

    if (!async) {
        startLoadingSpinnerAnimation();
    }

    xhr.onreadystatechange = function (event) {
        if (this.readyState !== 4) return;

        resultData = isJsonString(this.responseText) ? JSON.parse(this.responseText) : null;
        if (this.status === 200) {
            if (successCallbackFunction) {
                successCallbackFunction();
            }
        } else {
            if (errorCallbackFunction) {
                errorCallbackFunction();
            }
        }
    };

    let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    xhr.open(method, url, async);
    xhr.setRequestHeader('X-CSRF-TOKEN', csrfToken);
    xhr.setRequestHeader('content-type', 'application/json');
    xhr.send(JSON.stringify(data));

    if (!async) {
        endLoadingSpinnerAnimation();
    }

    return resultData;
}

function isJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

function startLoadingSpinnerAnimation() {
    if (document.querySelector('.loading-spinner-block')) {
        return;
    }

    let spinnerBlock = document.createElement('div');
    spinnerBlock.classList.add('loading-spinner-block');
    let spinnerElement = document.createElement('div');
    spinnerElement.classList.add('loading-spinner');
    spinnerElement.setAttribute('id', 'circularG');

    for (let i = 0; i < 8; i++) {
        let circularElement = document.createElement('div');
        circularElement.classList.add('circularG');
        circularElement.setAttribute('id', 'circularG_' + (i + 1));
        spinnerElement.appendChild(circularElement);
    }
    spinnerBlock.appendChild(spinnerElement);

    document.querySelector('body').appendChild(spinnerBlock);
}

function endLoadingSpinnerAnimation() {
    let loadingSpinnerBlockElement = document.querySelector('.loading-spinner-block');
    if (loadingSpinnerBlockElement) {
        loadingSpinnerBlockElement.remove();
    }
}
