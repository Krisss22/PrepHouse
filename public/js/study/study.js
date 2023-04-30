let studySearchElement = document.querySelector('.study-search-block input#search');

if (studySearchElement) {
    studySearchElement.onkeyup = function(event) {
        let topicsList = document.querySelectorAll('.study-topics-list .study-topic-item')
        topicsList.forEach(element => {
            if (!element.innerText.toLowerCase().includes(event.target.value.toLowerCase())) {
                element.classList.add('hidden');
            } else {
                element.classList.remove('hidden');
            }
        });
    }
}
