window.onload = function() {
    let response = sendRequest(
        'GET',
        '/notifications/getAllNotifications'
    );

    for (let notificationType in response) {
        for (let notification of response[notificationType]) {
            hideNotification(showNotification(notification, notificationType))
        }
    }
};

document.addEventListener('click', function(event) {
    let element = event.target;
    if (element.classList.contains('notification-item')) {
        hideNotification(element, 0);
    }
})

function showNotification(notificationText, type = 'info') {
    let notificationsBlock = document.querySelector('#notifications');
    let firstChild = notificationsBlock.firstChild;
    let notificationElement = document.createElement('div');
    notificationElement.classList.add('notification-item');
    notificationElement.classList.add(type);
    notificationElement.innerText = notificationText;
    notificationsBlock.insertBefore(notificationElement, firstChild);

    return notificationElement;
}

function hideNotification(element, timeout = 5000) {
    setTimeout(function() {
        hideEffect(element)
    }, timeout)
}

function hideEffect(element) {
    let minOpacity = 0
    let currentOpacity = (element.style.opacity) ? parseFloat(element.style.opacity) - 0.1 : 1;
    element.style.opacity = currentOpacity.toString()

    if (currentOpacity > minOpacity) {
        setTimeout(function() {
            hideEffect(element)
        }, 30)
    } else {
        element.remove();
    }
}
