document.addEventListener('click', function(event) {
    let element = event.target;

    if (element.getAttribute('id') === 'addNewTagInQuiz') {
        let divElement = document.createElement('div');
        let newQuizElementsCount = document.querySelectorAll('input.new-quiz-tag').length
        element = '<div class="col-5 quiz-tag-block-item-tag">' +
            '<label for="tag" class="form-label">Tag</label>' +
            '<div class="quiz-tag-block-item-delete">Delete</div>' +
            '<div class="search-select-element" data-json-name="tags" data-json-url="/admin/tags/get-json">' +
            '<input type="text" class="form-control search-select-input" value="">' +
            '<input type="text" class="search-select-input-hidden new-quiz-tag" name="newQuizTag[' + newQuizElementsCount + '][tagId]" value="">' +
            '</div>' +
            '</div>' +
            '<div class="col-1 quiz-tag-block-item-count">' +
            '<label for="count" class="form-label">Count</label>' +
            '<input type="number" class="form-control" name="newQuizTag[' + newQuizElementsCount + '][count]" value="" required>' +
            '</div>';
        divElement.classList.add('quiz-tag-block-item')
        divElement.innerHTML = element;
        document.querySelector('#addNewTagInQuiz').insertAdjacentElement('beforebegin', divElement)
    }

    if (element.classList.contains('quiz-tag-block-item-delete')) {
        element.parentNode.parentNode.remove();
    }
})
