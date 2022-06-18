const accessSelects = document.querySelectorAll('#edit-role-form .access-select');
accessSelects && accessSelects.forEach(select => {
    select.addEventListener('change', event => {
        const element = event.target;
        const input = element.parentNode.parentNode.querySelector('input');
        if (!input.value || input.value === '') {
            input.value = '0000'
        }

        switch (element.dataset.accessType) {
            case "show":
                input.value = writeAccessValueInString(input.value, 0, element.value);
                break;
            case "create":
                input.value = writeAccessValueInString(input.value, 1, element.value);
                break;
            case "update":
                input.value = writeAccessValueInString(input.value, 2, element.value);
                break;
            case "delete":
                input.value = writeAccessValueInString(input.value, 3, element.value);
                break;
        }
    });
});

function writeAccessValueInString(string, valuePosition, value) {
    let tmpString = ''
    for (let i = 0; i < string.length; i++) {
        i === valuePosition ? tmpString += value : tmpString += string[i];
    }

    return tmpString
}
