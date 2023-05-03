function showPopup(title = '', body = '') {
    const testPopup = document.querySelector("#testInfoPopup");
    const popupTitle = testPopup.querySelector("#titleInfoPopup");
    const popupBody = testPopup.querySelector("#bodyInfoPopup");

    popupTitle.innerHTML = title;
    popupBody.innerHTML = body;
    testPopup.classList.remove('hidden');
}

document.addEventListener('click', (event) => {
    const element = event.target;
    const elementId = element.getAttribute('id');
    if (elementId && elementId === 'closeInfoPopup') {
        document.querySelector("#testInfoPopup").classList.add('hidden');
    }
});
