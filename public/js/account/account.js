const userNoPhotoImageSrc = '../../storage/images/';
const userNoPhotoImageName = 'user.svg';

const accountUploadImageButton = document.querySelector('#account-upload-image-button');
accountUploadImageButton && accountUploadImageButton.addEventListener('click', function () {
    let uploadImageHiddenInput = document.querySelector('#account-upload-image-input');
    if (uploadImageHiddenInput) {
        uploadImageHiddenInput.click();
    }
});

const accountUploadImageInput = document.querySelector('#account-upload-image-input');
accountUploadImageInput && accountUploadImageInput.addEventListener('change', function() {
    if (this.files[0]) {
        let fr = new FileReader();

        fr.addEventListener("load", function () {
            let accountImageElement = document.querySelector('#account-image');
            accountImageElement.setAttribute('src', fr.result);
        }, false);

        fr.readAsDataURL(this.files[0]);
    }
});

const accountImageRemove = document.querySelector('#account-image-remove-button');
accountImageRemove && accountImageRemove.addEventListener('click', function() {
    let uploadImageHiddenInput = document.querySelector('#account-upload-image-input');
    if (uploadImageHiddenInput) {
        uploadImageHiddenInput.setAttribute('value', userNoPhotoImageName);
    }

    let accountImageElement = document.querySelector('#account-image');
    if (accountImageElement) {
        accountImageElement.setAttribute('src', userNoPhotoImageSrc + userNoPhotoImageName);
    }
});

const accountNotificationsNews = document.querySelector('#account-notifications-news');
accountNotificationsNews && accountNotificationsNews.addEventListener('change', function() {
    let response = sendRequest(
        'POST',
        '/account/notifications/save/',
        {
            "news": this.checked
        }
    );
});
const accountNotificationsSurveys = document.querySelector('#account-notifications-surveys');
accountNotificationsSurveys && accountNotificationsSurveys.addEventListener('change', function() {
    let response = sendRequest(
        'POST',
        '/account/notifications/save/',
        {
            "surveys": this.checked
        }
    );
});
const accountNotificationsPromotions = document.querySelector('#account-notifications-promotions');
accountNotificationsPromotions && accountNotificationsPromotions.addEventListener('change', function() {
    let response = sendRequest(
        'POST',
        '/account/notifications/save/',
        {
            "promotions": this.checked
        }
    );
});
