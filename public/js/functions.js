function sendRequest(method = 'GET', url, data = {}, async = false, successCallbackFunction = null, errorCallbackFunction = null) {
    let xhr = new XMLHttpRequest();
    let resultData = null;

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

    return resultData;
}

function sendQuestionAjax(url, method = "GET", formData = null) {
    let result = [];

    $.ajax({
        type: method,
        url: url,
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",
        async: false,
        success: function(data) {
            result = data;
        },
        error: function(data) {
            result = data;
        }
    });

    return result;
}
