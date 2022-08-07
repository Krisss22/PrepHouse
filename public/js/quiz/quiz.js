document.addEventListener('click', function(event) {
    let element = event.target;

    if (
        element.classList.contains('quiz-process-question-block-answers-block-item')
        || element.parentNode.classList.contains('quiz-process-question-block-answers-block-item')
    ) {
        let clickedAnswerElement = element.classList.contains('quiz-process-question-block-answers-block-item') ? element : element.parentNode;
        clickAnswer(clickedAnswerElement.dataset.answerId);
    }

    if (element.classList.contains('quiz-process-questions-button')) {
        loadQuestion(element.dataset.questionId);
    }

    if (
        (element.classList.contains('quiz-process-navigations-block-button-prev')
            || element.classList.contains('quiz-process-navigations-block-button-next'))
        && element.dataset.questionId !== ''
    ) {
        loadQuestion(element.dataset.questionId);
    }
});

function clickAnswer(answerId) {
    let questionId = document.querySelector('.quiz-process-right-block').dataset.quizQuestionId;
    let clickedAnswerElement = document.querySelector(`.quiz-process-question-block-answers-block-item[data-answer-id="${answerId}"]`)
    let questionButtonByQuestionIdElement = document.querySelector(`.quiz-process-questions-button[data-question-id="${questionId}"]`);

    const response = sendAnswer(questionId, answerId);
    if (response.status === 'success') {
        if (clickedAnswerElement.classList.contains('active')) {
            clickedAnswerElement.classList.remove('active');
        } else {
            clickedAnswerElement.classList.add('active');
        }

        let answersCount = document.querySelectorAll('.quiz-process-question-block-answers-block-item.active').length;

        if (answersCount > 0) {
            if (!questionButtonByQuestionIdElement.classList.contains('answered')) {
                questionButtonByQuestionIdElement.classList.add('answered');
            }
        } else {
            questionButtonByQuestionIdElement.classList.remove('answered');
        }

        setProgressPercent(response.processPercent);
    } else {
        console.error(response.errorMessage);
    }
}

function sendAnswer(questionId, answerId) {
    let quizActionId = document.querySelector('.quiz-process-left-block').dataset.quizActionId;
    let data = {
        "questionId": questionId,
        "answerId": answerId
    }

    return sendRequest(
        'POST',
        `/quiz/answerProcess/${quizActionId}`,
        data
    );
}

function loadQuestion(questionId) {
    let quizActionId = document.querySelector('.quiz-process-left-block').dataset.quizActionId;
    let response = sendRequest(
        'GET',
        `/quiz/getQuestion/${quizActionId}/${questionId}`
    );

    if (response.question) {
        let question = response.question
        let prevQuestionButtonElement = document.querySelector('.quiz-process-navigations-block-button-prev');
        prevQuestionButtonElement.dataset.questionId = response.previousQuestionId !== null ? response.previousQuestionId : '';
        response.previousQuestionId !== null ?
            prevQuestionButtonElement.classList.remove('disabled')
            :
            prevQuestionButtonElement.classList.add('disabled')

        let nextQuestionButtonElement = document.querySelector('.quiz-process-navigations-block-button-next');
        nextQuestionButtonElement.dataset.questionId = response.nextQuestionId !== null ? response.nextQuestionId : '';
        response.nextQuestionId !== null ?
            nextQuestionButtonElement.classList.remove('disabled')
            :
            nextQuestionButtonElement.classList.add('disabled')

        let questionBlockElement = document.querySelector('.quiz-process-right-block')
        questionBlockElement.dataset.quizQuestionId = question.id

        renderQuestion(question);
    } else {
        console.error('Can not get question data')
    }

    endLoadingSpinnerAnimation()
}

function renderQuestion(data) {
    let quizProcessQuestionBlock = document.querySelector('#quiz-process-question-block');
    let questionTitle = quizProcessQuestionBlock.querySelector('.quiz-process-question-block-title span');
    let questionTask = quizProcessQuestionBlock.querySelector('.quiz-process-question-block-task');
    let questionTaskImage = quizProcessQuestionBlock.querySelector('.quiz-process-question-block-image');
    let quizProcessQuestionBlockAnswersBlock = document.querySelector('#quiz-process-question-block-answers-block');

    let questionImage = data.questionImage
    if (questionImage) {
        questionTaskImage.innerHTML = `<img alt="" src="${questionImage}">`
    } else {
        questionTaskImage.innerHTML = ''
    }

    questionTitle.innerText = data.id + 1;
    questionTask.inner = data.question;
    quizProcessQuestionBlockAnswersBlock.innerHTML = '';

    for (let answer of data.answers) {
        let answerItemElement = getQuestionAnswerItemTemplate();
        answerItemElement.dataset.answerId = String(answer.realId);
        if (data.usersAnswer.indexOf(answer.realId) !== -1) {
            answerItemElement.classList.add('active');
        }
        answerItemElement.querySelector('.quiz-process-question-block-answers-block-item-numbering').innerHTML = answer.humanId;
        if (answer.image) {
            if (answer.imageFile) {
                answerItemElement.querySelector('.quiz-process-question-block-answers-block-item-option').innerHTML += `<img src="data:image/png;base64, ${answer.imageFile}">`;
            } else {
                answerItemElement.querySelector('.quiz-process-question-block-answers-block-item-option').innerHTML += answer.image;
            }
        }
        if (answer.text) {
            answerItemElement.querySelector('.quiz-process-question-block-answers-block-item-option').innerHTML += answer.text;
        }

        quizProcessQuestionBlockAnswersBlock.appendChild(answerItemElement);
    }
}

function getQuestionAnswerItemTemplate() {
    let quizQuestionAnswerItemTemplateElement = document.createElement('div');
    quizQuestionAnswerItemTemplateElement.className = 'quiz-process-question-block-answers-block-item';

    let quizQuestionAnswerItemNumberingElement = document.createElement('div');
    quizQuestionAnswerItemNumberingElement.className = 'quiz-process-question-block-answers-block-item-numbering';

    let quizQuestionAnswerItemOptionElement = document.createElement('div');
    quizQuestionAnswerItemOptionElement.className = 'quiz-process-question-block-answers-block-item-option';
    quizQuestionAnswerItemTemplateElement.appendChild(quizQuestionAnswerItemNumberingElement);
    quizQuestionAnswerItemTemplateElement.appendChild(quizQuestionAnswerItemOptionElement);

    return quizQuestionAnswerItemTemplateElement;
}

function setProgressPercent(percent) {
    let progressPercentNumber = document.querySelector('#quiz-process-progress-data');
    let progressPercentElement = document.querySelector('#quiz-process-progress-progress-finish');
    if (progressPercentNumber && progressPercentElement) {
        progressPercentNumber.innerHTML = `${percent}%`
        progressPercentElement.style.width = `${percent}%`;
    }
}
