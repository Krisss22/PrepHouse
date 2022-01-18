function sendRequest(method = 'GET', url, data = {}, async = false, successCallbackFunction = null, errorCallbackFunction = null) {
    let xhr = new XMLHttpRequest();
    let resultData = null;

    if (!async) {
        startLoadingSpinnerAnimation();
    }

    xhr.onreadystatechange = function (event) {
        if (this.readyState !== 4) return;

        resultData = JSON.parse(this.responseText);
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

// function sendQuestionAjax(url, method = "GET", formData = null) {
//     let result = [];
//
//     $.ajax({
//         type: method,
//         url: url,
//         data: formData,
//         processData: false,
//         contentType: false,
//         dataType: "json",
//         async: false,
//         success: function(data) {
//             result = data;
//         },
//         error: function(data) {
//             result = data;
//         }
//     });
//
//     return result;
// }

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
