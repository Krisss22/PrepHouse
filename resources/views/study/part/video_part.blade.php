<div class="study-materials-item study-materials-item-video">
    <div class="study-materials-item-video-thumbnail"><img src="{{ $video->getFullPathImage() }}"></div>
    <div title="{{ $video->title }}" class="study-materials-item-video-title">{{ $video->title }}</div>
    <div title="{{ $video->description }}" class="study-materials-item-video-description">{{ $video->description }}</div>
    <div class="study-materials-item-video-action">
        <a href="{{ $video->link }}" target="_blank" class="study-materials-item-video-action-view">View Video</a>
        <a class="study-materials-item-video-action-bookmark"></a>
        <a class="study-materials-item-video-action-viewed"></a>
    </div>
</div>
