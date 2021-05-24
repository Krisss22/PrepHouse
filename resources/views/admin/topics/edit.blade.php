@extends('admin.layouts.admin')

@section('content')
    <h1>Vacancy {{ $topic->id }}</h1>

    <form method="post" action="/admin/topics/{{ $action }}{{ $topic->id ? '/' . $topic->id : '' }}" id="edit-vacancy-form" class="row g-3 content-edit-group">
        @method('post')
        @csrf
        <div class="col-7">
            <label for="name" class="form-label">Topic name</label>
            @error('name')
            <span class="invalid-name" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="text" class="form-control" name="name" id="name" value="{{ $topic->name }}" required>
        </div>
    </form>

    <a href="/admin/topics/list" type="button" class="btn btn-primary">Back</a>
    @if($action === \App\Http\Controllers\Admin\TopicController::ACTION_EDIT)
        <button type="submit" value="Update" form="edit-vacancy-form" class="btn btn-success">Update</button>
        <a href="/admin/topics/delete/{{ $topic->id }}}" class="btn btn-danger">Delete</a>
    @else
        <button type="submit" value="Create" form="edit-topic-form" class="btn btn-success">Create</button>
    @endif

@endsection
