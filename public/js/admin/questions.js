let addAnswerButton = document.querySelector('#addAnswerButton');
addAnswerButton && addAnswerButton.addEventListener('click', function(event) {
    let addAnswerButtonsBlock = document.querySelector('#addAnswerButtonsBlock');
    if (addAnswerButtonsBlock && addAnswerButtonsBlock.classList.contains('hidden')) {
        addAnswerButtonsBlock.classList.remove('hidden');
    }
});

let addAnswerTypeButtons = document.querySelectorAll('#addAnswerButtonsBlock .add-answer-type-button');
addAnswerTypeButtons && addAnswerTypeButtons.forEach(function(element) {
    element.addEventListener('click', function(event) {
        let type = event.target.dataset.answerType,
            answersBlock = document.querySelector('#answersBlock'),
            element = '',
            answersCount = answersBlock.querySelectorAll('label').length + document.querySelectorAll('#questionAnswersBlock label').length,
            addAnswerButtonsBlock = document.querySelector('#addAnswerButtonsBlock');

        if (type === 'text') {
            ++answersCount;
            element = '<label for="answerText">Answer ' + answersCount + '</label>' +
                '<textarea type="text" id="answerText" name="newTextAnswer[]">Answer ' + answersCount + '</textarea>';
        }
        if (type === 'file') {
            ++answersCount;
            element = '<label for="answerFile">Answer ' + answersCount + '</label>' +
                '<input id="answerFile" name="newFileAnswer[]" type="file" value="">';
        }

        if (addAnswerButtonsBlock && !addAnswerButtonsBlock.classList.contains('hidden')) {
            addAnswerButtonsBlock.classList.add('hidden');
        }

        answersBlock.innerHTML += element;
    });
});

let removeAnswerButtons = document.querySelectorAll('.remove-answer-button');
removeAnswerButtons && removeAnswerButtons.forEach(function(element) {
    element.addEventListener('click', function(event) {
        let questionAnswersBlock = document.querySelector('#questionAnswersBlock'),
            id = event.target.dataset.id;

        questionAnswersBlock.querySelectorAll('label, img, input, textarea, div').forEach((el) => {
            if (el.dataset.id === id) {
                el.remove();
            }
        });
    });
});
