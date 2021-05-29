function sendQuestionAjax(url, formData = null, method = "GET") {
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
