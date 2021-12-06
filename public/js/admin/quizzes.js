document.addEventListener('click', function(event) {
    let element = event.target;

    if (element.getAttribute('id') === 'addNewTagInQuiz') {
        let newQuizElementsCount = document.querySelectorAll('input.new-quiz-tag').length

        let quizItemLabelTemplateElement = document.createElement('label');
        quizItemLabelTemplateElement.setAttribute('for', 'tag');
        quizItemLabelTemplateElement.classList.add('form-label');
        quizItemLabelTemplateElement.append('Tag');

        let quizItemDeleteButtonTemplateElement = document.createElement('div');
        quizItemDeleteButtonTemplateElement.classList.add('quiz-tag-block-item-delete');
        quizItemDeleteButtonTemplateElement.append('Delete');

        let quizItemSearchInputTemplateElement = document.createElement('input');
        quizItemSearchInputTemplateElement.setAttribute('type', 'text');
        quizItemSearchInputTemplateElement.classList.add('form-control', 'search-select-input');

        let quizItemSearchHiddenInputTemplateElement = document.createElement('input');
        quizItemSearchHiddenInputTemplateElement.setAttribute('type', 'text');
        quizItemSearchHiddenInputTemplateElement.setAttribute('name', `newQuizTag[${newQuizElementsCount}][tagId]`);
        quizItemSearchHiddenInputTemplateElement.classList.add('search-select-input-hidden', 'new-quiz-tag');

        let quizItemSearchDivTemplateElement = document.createElement('div');
        quizItemSearchDivTemplateElement.setAttribute('data-json-name', 'tags');
        quizItemSearchDivTemplateElement.setAttribute('data-json-url', '/admin/tags/get-json');
        quizItemSearchDivTemplateElement.classList.add('search-select-element');
        quizItemSearchDivTemplateElement.appendChild(quizItemSearchInputTemplateElement);
        quizItemSearchDivTemplateElement.appendChild(quizItemSearchHiddenInputTemplateElement);

        let quizItemCountLabelTemplateElement = document.createElement('label');
        quizItemCountLabelTemplateElement.setAttribute('for', 'count');
        quizItemCountLabelTemplateElement.classList.add('form-label');
        quizItemCountLabelTemplateElement.append('Count');

        let quizItemCountInputTemplateElement = document.createElement('input');
        quizItemCountInputTemplateElement.setAttribute('type', 'number');
        quizItemCountInputTemplateElement.required = true;
        quizItemCountInputTemplateElement.setAttribute('name', `newQuizTag[${newQuizElementsCount}][count]">`);
        quizItemCountInputTemplateElement.classList.add('form-control');

        let quizItemTagTemplateElement = document.createElement('div');
        quizItemTagTemplateElement.classList.add('col-5', 'quiz-tag-block-item-tag');
        quizItemTagTemplateElement.appendChild(quizItemLabelTemplateElement);
        quizItemTagTemplateElement.appendChild(quizItemDeleteButtonTemplateElement);
        quizItemTagTemplateElement.appendChild(quizItemSearchDivTemplateElement);

        let quizItemCountTemplateElement = document.createElement('div');
        quizItemCountTemplateElement.classList.add('col-1', 'quiz-tag-block-item-count');
        quizItemCountTemplateElement.appendChild(quizItemCountLabelTemplateElement);
        quizItemCountTemplateElement.appendChild(quizItemCountInputTemplateElement);

        let quizItemTemplateElement = document.createElement('div');
        quizItemTemplateElement.classList.add('quiz-tag-block-item');
        quizItemTemplateElement.appendChild(quizItemTagTemplateElement);
        quizItemTemplateElement.appendChild(quizItemCountTemplateElement);

        document.querySelector('#addNewTagInQuiz').insertAdjacentElement('beforebegin', quizItemTemplateElement)
    }

    if (element.classList && element.classList.contains('quiz-tag-block-item-delete')) {
        element.parentNode.parentNode.remove();
    }
})
