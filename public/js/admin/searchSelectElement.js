let searchSelectBlocks = document.querySelectorAll('.search-select-element');
searchSelectBlocks && searchSelectBlocks.forEach((block) => {
    let searchSelectInput = block.querySelector('.search-select-input');
    if (searchSelectInput) {
        searchSelectInput.addEventListener('click', (event) => {
            event.preventDefault();

            showSelectResults(searchSelectInput);
        });

        searchSelectInput.addEventListener('keyup', (event) => {
            event.preventDefault();

            showSelectResults(searchSelectInput);

            let searchText = event.target.value;
            if (searchText === '') {
                let hiddenInput = block.querySelector('.search-select-input-hidden');
                hiddenInput.value = '';
            } else {
                let resultItems = document.querySelectorAll('.search-select-element .search-select-results-item');
                resultItems.forEach(function(element) {
                    if (element.innerHTML.toLocaleLowerCase().trim().indexOf(searchText.toLocaleLowerCase().trim()) !== -1) {
                        if (element.classList.contains('search-select-results-item-hidden')) {
                            element.classList.remove('search-select-results-item-hidden');
                        }
                    } else {
                        if (!element.classList.contains('search-select-results-item-hidden')) {
                            element.classList.add('search-select-results-item-hidden');
                        }
                    }
                });
            }
        });
    }

    let searchSelectResultItems = block.querySelectorAll('.search-select-results-item');
    searchSelectResultItems && searchSelectResultItems.forEach((element) => {
        element.addEventListener('click', (event) => {
            let hiddenInput = block.querySelector('.search-select-input-hidden');
            hiddenInput.value = event.target.dataset.tagId
            searchSelectInput.value = event.target.innerHTML
        })
    })
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
