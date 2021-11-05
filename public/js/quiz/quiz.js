document.addEventListener('click', function(event) {
    let element = event.target;

    if (
        element.classList.contains('quiz-process-question-block-answers-block-item')
        || element.parentNode.classList.contains('quiz-process-question-block-answers-block-item')
    ) {
        let clickedAnswerElement = element.classList.contains('quiz-process-question-block-answers-block-item') ? element : element.parentNode;
        clickAnswer(clickedAnswerElement.dataset.answerId);
    }
});

function clickAnswer(answerId) {
    let questionId = document.querySelector('.quiz-process-right-block').dataset.quizQuestionId;
    let questionButtonByQuestionIdElement = document.querySelector(`.quiz-process-questions-button[data-question-id="${questionId}"]`);
    let answerItemElements = document.querySelectorAll('.quiz-process-question-block-answers-block-item');

    for (let answerItem of answerItemElements) {
        if (answerItem.dataset.answerId === answerId && !answerItem.classList.contains('active')) {
            answerItem.classList.add('active');

            let response = sendAnswer(questionId, answerId);
            if (!questionButtonByQuestionIdElement.classList.contains('answered') && response.success) {
                questionButtonByQuestionIdElement.classList.add('answered')
            }
        } else {
            answerItem.classList.remove('active');
        }
    }
}

function sendAnswer(questionId, answerId) {
    let quizActionId = document.querySelector('.quiz-process-left-block').dataset.quizActionId;
    let data = {
        "questionId": questionId,
        "answerId": answerId
    };

    return sendRequest(
        'POST',
        `/quiz/quizAnswerProcess/${quizActionId}`,
        JSON.stringify(data)
    );
}

function loadQuestion(questionId) {
    //!!!
}

function setProgressPercent(percent) {
    let progressPercentNumber = document.querySelector('#quiz-process-progress-data');
    let progressPercentElement = document.querySelector('#quiz-process-progress-progress-finish');
    if (progressPercentNumber && progressPercentElement) {
        progressPercentNumber.innerHTML = `${percent}%`
        progressPercentElement.style.width = `${percent}%`;
    }
}
