let feedbackItemsBlock = document.querySelector('.feedback-block .feedback-items')
let feedbackItemsBlockItems = document.querySelectorAll('.feedback-block .feedback-items .feedback-item')
let feedbackItemsLine = document.querySelector('div.feedback-items-line')

document.addEventListener('click', function(event) {
    let element = event.target;

    if (element.classList.contains('go-left') && element.tagName === 'IMG') {
        swipeSliderLeft()
    }

    if (element.classList.contains('go-right') && element.tagName === 'IMG') {
        swipeSliderRight()
    }
})

function swipeSliderLeft() {
    let sliderItemWidth = feedbackItemsBlockItems[0].clientWidth
    let sliderItemMarginRight = getComputedStyle(feedbackItemsBlockItems[0]).marginRight.split('px')[0]
    let swipeInPixels = sliderItemWidth + parseInt(sliderItemMarginRight)
    let feedbackItemsLineMarginLeft = 0
    if (feedbackItemsLine.style.marginLeft && feedbackItemsLine.style.marginLeft !== '') {
        feedbackItemsLineMarginLeft = feedbackItemsLine.style.marginLeft.split('px')[0]
        swipeInPixels += parseInt(feedbackItemsLineMarginLeft)
    }

    if (feedbackItemsLineMarginLeft >= 0) {
        return
    }

    feedbackItemsLine.style.marginLeft = String(swipeInPixels + 'px')
}

function swipeSliderRight() {
    let sliderItemWidth = feedbackItemsBlockItems[0].clientWidth
    let sliderItemMarginRight = getComputedStyle(feedbackItemsBlockItems[0]).marginRight.split('px')[0]
    let sliderItemFullWidth = sliderItemWidth + parseInt(sliderItemMarginRight)
    let maxItemsInSlider = Math.floor(feedbackItemsBlock.clientWidth / sliderItemFullWidth)
    let swipeInPixels = sliderItemFullWidth
    let feedbackItemsLineMarginLeft = 0
    if (feedbackItemsLine.style.marginLeft && feedbackItemsLine.style.marginLeft !== '') {
        feedbackItemsLineMarginLeft = feedbackItemsLine.style.marginLeft.split('px')[0]
        swipeInPixels -= feedbackItemsLineMarginLeft
    }
    let visibleItemsInPixels = (feedbackItemsBlockItems.length - 1) * sliderItemFullWidth - Math.abs(feedbackItemsLineMarginLeft)
    let minVisibleItemsInPixels = maxItemsInSlider * sliderItemFullWidth

    if (visibleItemsInPixels < minVisibleItemsInPixels) {
        return
    }

    feedbackItemsLine.style.marginLeft = String(-swipeInPixels + 'px')
}
