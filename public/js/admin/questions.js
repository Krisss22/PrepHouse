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
            answersCount = answersBlock.querySelectorAll('.answerBlockItem').length,
            addAnswerButtonsBlock = document.querySelector('#addAnswerButtonsBlock');

        if (type === 'text') {
            ++answersCount;
            element = '<div class="answerBlockItem"><label for="answerText">Answer ' + answersCount + '</label><div class="remove-answer-button">Delete</div>' +
                '<br><label>Is correct: </label><input class="answer-correct-input" type="checkbox" name="newTextAnswer[new' + answersCount + '][correct]">' +
                '<textarea type="text" id="answerText" name="newTextAnswer[new' + answersCount + '][value]">Answer ' + answersCount + '</textarea></div>';
        }
        if (type === 'file') {
            ++answersCount;
            element = '<div class="answerBlockItem"><label for="answerFile">Answer ' + answersCount + '</label><div class="remove-answer-button">Delete</div>' +
                '<br><label>Is correct: </label><input class="answer-correct-input" type="checkbox" name="newFileAnswer[new' + answersCount + '][correct]">' +
                '<input id="answerFile" name="newFileAnswer[new' + answersCount + '][value]" type="file" value=""></div>';
        }

        if (addAnswerButtonsBlock && !addAnswerButtonsBlock.classList.contains('hidden')) {
            addAnswerButtonsBlock.classList.add('hidden');
        }

        let lastAnswerElement = document.querySelector('#answersBlock').lastElementChild
        if (lastAnswerElement) {
            let divElement = document.createElement('div');
            divElement.classList.add('answerBlockItem')
            divElement.innerHTML = element;
            lastAnswerElement.insertAdjacentElement('afterEnd', divElement)
        } else {
            answersBlock.innerHTML += element;
        }
    });
});

document.addEventListener('click', function(event) {
    let element = event.target;

    if (element.classList.contains('remove-answer-button')) {
        element.parentNode.remove();
    }
})
