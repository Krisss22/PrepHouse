@extends('admin.layouts.admin')

@section('content')
    <h1 class="study-list-title">Study add book</h1>

    <form method="post" action="{{ $action === \App\Http\Controllers\Admin\AdminController::ACTION_EDIT ? route('admin-study-edit-book', $book->id) : route('admin-study-create-book', $topicId) }}" id="edit-study-form" enctype="multipart/form-data" class="row g-3 content-edit-group">
        @method('post')
        @csrf
        <div class="col-7">
            <label for="title" class="form-label">Title</label>
            @error('title')
            <span class="invalid-title" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="text" class="form-control" name="title" id="title" value="{{ $book->title }}" required>
        </div>
        <div class="col-7">
            <label for="title" class="form-label">Author</label>
            @error('author')
            <span class="invalid-author" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="text" class="form-control" name="author" id="author" value="{{ $book->author }}" required>
        </div>
        <div class="col-7">
            <label for="description" class="form-label">Description</label>
            @error('description')
            <span class="invalid-description" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="text" class="form-control" name="description" id="description" value="{{ $book->description }}" required>
        </div>
        <div class="col-7">
            <label for="image" class="form-label">Image</label>
            @error('image')
            <span class="invalid-image" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            @if($book->image)
                <br>
                <img src="{{ asset('storage/images/study/books/' . $book->image) }}">
            @endif
            <input type="file" class="form-control" name="image" id="image" >
        </div>
        <div class="col-7">
            <label for="image" class="form-label">File</label>
            @error('file')
            <span class="invalid-image" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            @if($book->file)
                <br>
                <a href="{{ asset('storage/files/study/books/' . $book->file) }}" target="_blank">{{ $book->file }}</a>
            @endif
            <input type="file" class="form-control" name="file" id="file" >
        </div>
    </form>

    <a href="{{ route('admin-study-books', $topicId) }}" type="button" class="btn btn-primary">Back</a>
    @if($action === \App\Http\Controllers\Admin\AdminController::ACTION_EDIT)
        <button type="submit" value="Update" form="edit-study-form" class="btn btn-success">Update</button>
        <a href="{{ route('admin-study-remove-book', $book->id) }}" class="btn btn-danger">Delete</a>
    @else
        <button type="submit" value="Create" form="edit-study-form" class="btn btn-success">Create</button>
    @endif

@endsection
