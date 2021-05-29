const searchTagUrl = '/admin/questions/search-tag/';

let searchSelectInputs = document.querySelectorAll('.search-select-element .search-select-input');
searchSelectInputs && searchSelectInputs.forEach((element) => {
    element.addEventListener('click', (event) => {
        event.preventDefault();

        let searchSelectResults = element.parentNode.querySelector('.search-select-results');
        searchSelectResults.classList.add('search-select-results-show')
    })

    element.addEventListener('keyup', (event) => {
        event.preventDefault();

        let result = sendQuestionAjax(searchTagUrl + event.target.value, null, 'GET');
        console.log(result)
    })
})

document.querySelector('body').addEventListener('click', (event) => {
    if (!event.target.classList.contains('search-select-results') && !event.target.classList.contains('search-select-input')) {
        document.querySelectorAll('.search-select-results-show').forEach((element) => {
            element.classList.remove('search-select-results-show');
        })
    }
})
