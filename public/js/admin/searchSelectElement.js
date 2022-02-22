let searchSelectElementJsons = [];

document.addEventListener('DOMContentLoaded', () => {
    let searchSelectInputs = document.querySelectorAll('.search-select-element');
    searchSelectInputs.forEach((el) => {
        loadJson(el.dataset.jsonUrl, el.dataset.jsonName);

        createSelectElements(el);
    });
});

document.addEventListener('click', (event) => {
    let element = event.target;

    if (element.classList.contains('search-select-input')) {
        event.preventDefault();

        let searchSelectElement = element.parentNode;
        if (!searchSelectElement.querySelector('.search-select-results')) {
            loadJson(searchSelectElement.dataset.jsonUrl, searchSelectElement.dataset.jsonName);

            createSelectElements(searchSelectElement);
        }

        showSelectResults(element);
    }

    if (element.classList.contains('search-select-results-item')) {
        event.preventDefault();

        let hiddenInput = element.parentNode.parentNode.querySelector('.search-select-input-hidden');
        let searchSelectInput = element.parentNode.parentNode.querySelector('.search-select-input');
        hiddenInput.value = element.dataset.tagId;
        searchSelectInput.value = element.innerHTML;
    }
});

document.addEventListener('keyup', (event) => {
    let element = event.target;

    if (element.classList.contains('search-select-input')) {
        event.preventDefault();

        showSelectResults(element);

        let searchText = element.value;
        if (searchText === '') {
            let hiddenInput = element.parentNode.parentNode.querySelector('.search-select-input-hidden');
            hiddenInput.value = '';
        } else {
            let resultItems = document.querySelectorAll('.search-select-element .search-select-results-item');
            resultItems.forEach(function(el) {
                if (el.innerHTML.toLocaleLowerCase().trim().indexOf(searchText.toLocaleLowerCase().trim()) !== -1) {
                    if (el.classList.contains('search-select-results-item-hidden')) {
                        el.classList.remove('search-select-results-item-hidden');
                    }
                } else {
                    if (!el.classList.contains('search-select-results-item-hidden')) {
                        el.classList.add('search-select-results-item-hidden');
                    }
                }
            });
        }
    }
});

document.querySelector('body').addEventListener('click', (event) => {
    if (!event.target.classList.contains('search-select-results') && !event.target.classList.contains('search-select-input')) {
        document.querySelectorAll('.search-select-results-show').forEach((element) => {
            element.classList.remove('search-select-results-show');
        });
    }
})

function showSelectResults(element) {
    let searchSelectResults = element.parentNode.querySelector('.search-select-results');
    if (!searchSelectResults.classList.contains('search-select-results-show') ) {
        searchSelectResults.classList.add('search-select-results-show')
    }
}

function loadJson(jsonUrl, jsonName) {
    if (searchSelectElementJsons[jsonName]) {
        return;
    }

    searchSelectElementJsons[jsonName] = sendRequest('GET', jsonUrl);
}

function createSelectElements(element) {
    let divElement = document.createElement('div');
    divElement.classList.add('search-select-results');
    element.lastElementChild.insertAdjacentElement('afterEnd', divElement)

    let searchSelectResultsElement = element.querySelector('.search-select-results');

    searchSelectElementJsons[element.dataset.jsonName] && searchSelectElementJsons[element.dataset.jsonName].length > 0 && searchSelectElementJsons[element.dataset.jsonName].forEach((item) => {
        let divSelectItemElement = document.createElement('div');
        divSelectItemElement.classList.add('search-select-results-item');
        divSelectItemElement.classList.add('search-select-results-item-hidden');
        divSelectItemElement.dataset['tagId'] = item.id;
        divSelectItemElement.innerText = item.name;

        searchSelectResultsElement.append(divSelectItemElement)
    });
}
