<div class="study-materials-item study-materials-item-site">
    <div class="study-materials-item-site-cover">
        <img src="{{ $site->getFullPathImage() }}">
    </div>
    <div class="study-materials-item-site-title">{{ $site->title }}</div>
    <div class="study-materials-item-site-description">{{ $site->description }}</div>
    <div class="study-materials-item-site-action">
        <a href="{{ $site->link }}" target="_blank" class="study-materials-item-site-action-view">Visit Site</a>
        <a class="study-materials-item-site-action-bookmark"></a>
        <a class="study-materials-item-site-action-viewed"></a>
    </div>
</div>
