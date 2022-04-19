<div class="study-materials-item study-materials-item-material">
    <div class="study-materials-item-material-cover">
        <img src="{{ $material->getFullPathImage() }}">
    </div>
    <div class="study-materials-item-material-title">{{ $material->title }}</div>
    <div class="study-materials-item-material-meta-info">{{ $material->getFileMetaInfo() }}</div>
    <div class="study-materials-item-material-action">
        <a class="study-materials-item-material-action-view">View</a>
        <a class="study-materials-item-material-action-bookmark"></a>
    </div>
</div>
