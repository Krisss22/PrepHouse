let sendQuestionButton = document.querySelector('#sendQuestionButton');
sendQuestionButton && sendQuestionButton.addEventListener('click', function(e) {
    let formElement = new FormData(document.querySelector('#sendQuestionForm'));
    $.ajax({
        type: "POST",
        url: "/home/send-question",
        data: formElement,
        processData: false,
        contentType: false,
        dataType: "json",
        // async: true,
        success: function(data) {
            $('#questionModal').modal('hide');
            console.log(data);
        },
        error: function(data) {
            console.log(data.responseJSON);
        }
    });
});
