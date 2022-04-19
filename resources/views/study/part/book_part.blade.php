<div class="study-materials-item study-materials-item-book">
    <div class="study-materials-item-book-cover">
        <img src="{{ $book->getFullPathImage() }}">
    </div>
    <div class="study-materials-item-book-info-block">
        <div class="study-materials-item-book-title">{{ $book->title }}</div>
        <div class="study-materials-item-book-author">By {{ $book->author }}</div>
        <div class="study-materials-item-book-description">{{ $book->description }}</div>
        <div class="study-materials-item-book-action">
            <a href="/" class="study-materials-item-book-action-download">Download</a>
            <a class="study-materials-item-book-action-bookmark"></a>
        </div>
    </div>
</div>
