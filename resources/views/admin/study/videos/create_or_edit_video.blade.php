@extends('admin.layouts.admin')

@section('content')
    <h1 class="study-list-title">Study add video</h1>

    <form method="post" action="{{ $action === \App\Http\Controllers\Admin\AdminController::ACTION_EDIT ? route('admin-study-edit-video', $video->id) : route('admin-study-create-video', $topicId) }}" id="edit-study-form" enctype="multipart/form-data" class="row g-3 content-edit-group">
        @method('post')
        @csrf
        <div class="col-7">
            <label for="title" class="form-label">Title</label>
            @error('title')
            <span class="invalid-title" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="text" class="form-control" name="title" id="title" value="{{ $video->title }}" required>
        </div>
        <div class="col-7">
            <label for="description" class="form-label">Description</label>
            @error('description')
            <span class="invalid-description" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="text" class="form-control" name="description" id="description" value="{{ $video->description }}" required>
        </div>
        <div class="col-7">
            <label for="image" class="form-label">Image</label>
            @error('image')
            <span class="invalid-image" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            @if($video->image)
                <br>
                <img src="{{ asset('storage/images/study/videos/' . $video->image) }}">
            @endif
            <input type="file" class="form-control" name="image" id="image" >
        </div>
        <div class="col-7">
            <label for="link" class="form-label">Link</label>
            @error('link')
            <span class="invalid-link" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="text" class="form-control" name="link" id="link" value="{{ $video->link }}" required>
        </div>
    </form>

    <a href="{{ route('admin-study-videos', $topicId) }}" type="button" class="btn btn-primary">Back</a>
    @if($action === \App\Http\Controllers\Admin\AdminController::ACTION_EDIT)
        <button type="submit" value="Update" form="edit-study-form" class="btn btn-success">Update</button>
        <a href="{{ route('admin-study-remove-video', $video->id) }}" class="btn btn-danger">Delete</a>
    @else
        <button type="submit" value="Create" form="edit-study-form" class="btn btn-success">Create</button>
    @endif

@endsection
