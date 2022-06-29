<div class="study-materials-item study-materials-item-material">
    <div class="study-materials-item-material-cover">
        <img src="{{ $material->getFullPathImage() }}">
    </div>
    <div title="{{ $material->title }}" class="study-materials-item-material-title">{{ $material->title }}</div>
    <div title="{{ $material->getFileMetaInfo() }}" class="study-materials-item-material-meta-info">{{ $material->getFileMetaInfo() }}</div>
    <div class="study-materials-item-material-action">
        <a href="{{ $material->getFullPathToFile() }}" class="study-materials-item-material-action-view">Download</a>
        <a class="study-materials-item-material-action-bookmark"></a>
    </div>
</div>
