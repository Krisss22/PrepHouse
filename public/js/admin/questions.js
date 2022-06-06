let addAnswerTypeButtons = document.querySelectorAll('#addAnswerButton');
addAnswerTypeButtons && addAnswerTypeButtons.forEach(function(element) {
    element.addEventListener('click', function(event) {
        let answersBlock = document.querySelector('#questionAnswersBlock'),
            element = '',
            answersCount = answersBlock.querySelectorAll('.answerBlockItem').length,
            addAnswerButtonsBlock = document.querySelector('#addAnswerButtonsBlock');

        ++answersCount;
        element += '<label for="answerText">Answer ' + answersCount + '</label><div class="remove-answer-button">Delete</div>' +
            '<br><label>Is correct: </label><input class="answer-correct-input" type="checkbox" name="isCorrect[new' + answersCount + ']">' +
            '<input id="answerFile" name="newFileAnswer[new' + answersCount + '][value]" type="file" value="">' +
            '<textarea type="text" id="answerText" name="newTextAnswer[new' + answersCount + '][value]">Answer ' + answersCount + '</textarea>';


        if (addAnswerButtonsBlock && !addAnswerButtonsBlock.classList.contains('hidden')) {
            addAnswerButtonsBlock.classList.add('hidden');
        }

        let lastAnswerElement = document.querySelector('#questionAnswersBlock').lastElementChild
        if (lastAnswerElement) {
            let divElement = document.createElement('div');
            divElement.classList.add('answerBlockItem')
            divElement.innerHTML = element;
            lastAnswerElement.insertAdjacentElement('afterEnd', divElement)
        } else {
            answersBlock.innerHTML += '<div class="answerBlockItem">' + element + '</div>';
        }
    });
});

document.addEventListener('click', function(event) {
    let element = event.target;

    if (element.classList.contains('remove-answer-button')) {
        element.parentNode.remove();
    }
})
