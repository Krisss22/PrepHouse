const notificationPopup = document.querySelector('#notificationPopup');

function sendQuestionAjax(formData, successFunction, errorFunction) {
    $.ajax({
        type: "POST",
        url: "/home/send-question",
        data: formData,
        processData: false,
        contentType: false,
        dataType: "json",
        success: function(data) {
            successFunction(data);
        },
        error: function(data) {
            errorFunction(data)
        }
    });
}

function showNotification(text, type = "success") {
    notificationPopup.innerHTML = text;
    notificationPopup.classList.add('notificationPopup' + type.charAt(0).toUpperCase() + type.slice(1));
    notificationPopup.classList.add('notificationPopupShow');
    setTimeout(function() {
        notificationPopup.setAttribute('class', '');
        notificationPopup.innerHTML = '';
    }, 3000);
}

let sendQuestionButton = document.querySelector('#sendQuestionButton');
sendQuestionButton && sendQuestionButton.addEventListener('click', function(e) {
    let formElement = new FormData(document.querySelector('#sendQuestionForm'));
    let successFunction = function(data) {
        $('#questionModal').modal('hide');
        showNotification('The question was successfully sent', 'success');

        console.log(data);
    };
    let errorFunction = function(data) {
        console.log(data.responseJSON);
    };
    sendQuestionAjax(formElement, successFunction, errorFunction);
});

let homeSubmitQuestionFormButton = document.querySelector('#home-submit-question-form-button');
homeSubmitQuestionFormButton && homeSubmitQuestionFormButton.addEventListener('click', function(e) {
    e.preventDefault();

    let formElement = new FormData(document.querySelector('#homeQuestionForm'));
    let successFunction = function(data) {
        let homeQuestionForm = document.querySelector('#homeQuestionForm')
        homeQuestionForm.querySelector('#formQuestion').value = '';
        homeQuestionForm.querySelector('#formAnswer').value = '';
        showNotification('Thank you for contribution to our PREP comunity! You helped', 'success');

        console.log(data);
    };
    let errorFunction = function(data) {
        console.log(data.responseJSON);
    };
    sendQuestionAjax(formElement, successFunction, errorFunction);
})

let linkSmallImagesList = document.querySelectorAll('.home-middle-block-feedback-block-left-images-list img')
linkSmallImagesList && linkSmallImagesList.forEach((item) => {
    item.addEventListener('click', function(e) {
        e.preventDefault();

        let element = e.target
        document.querySelectorAll('.home-middle-block-feedback-block-left-images-list img').forEach((el) => {
            if (el.getAttribute('data-feedback-id') === element.getAttribute('data-feedback-id')) {
                el.classList.add('active')
            } else {
                el.classList.remove('active')
            }
        })

        document.querySelectorAll('.home-middle-block-feedback-block-left-text-list-item').forEach((el) => {
            if (el.getAttribute('data-feedback-id') === element.getAttribute('data-feedback-id')) {
                el.classList.add('active')
            } else {
                el.classList.remove('active')
            }
        })

        document.querySelectorAll('.home-middle-block-feedback-block-right img').forEach(function(el) {
            if (el.getAttribute('data-feedback-id') === element.getAttribute('data-feedback-id')) {
                el.classList.add('active')
            } else {
               el.classList.remove('active')
            }
        })
    })
})
