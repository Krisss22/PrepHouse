const TRIGGER_TITLE_NAME = 'Other'

let shareQuestionTitlesItems = document.querySelectorAll('.share-question-titles-item');
shareQuestionTitlesItems && shareQuestionTitlesItems.forEach(function(item) {
    item.addEventListener('click', function(e) {
        const element = e.currentTarget;
        const titleInput = document.querySelector('#share-question-title')

        if (!element.classList.contains('active')) {
            let activeElement = document.querySelector('.share-question-titles-item.active');
            if (activeElement) {
                activeElement.classList.remove('active');
            }
            element.classList.add('active');

            let titleInputParent = titleInput.parentNode
            if (element.querySelector('span').innerText === TRIGGER_TITLE_NAME) {
                titleInputParent.classList.remove('hidden');
                titleInput.value = '';
            } else {
                titleInputParent.classList.add('hidden');
                titleInput.value = element.querySelector('span').innerText;
            }
        }
    });
});
