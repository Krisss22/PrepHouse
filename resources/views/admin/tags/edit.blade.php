@extends('admin.layouts.admin')

@section('content')
    <h1>Vacancy {{ $tag->id }}</h1>

    <form method="post" action="/admin/tags/{{ $action }}{{ $tag->id ? '/' . $tag->id : '' }}" id="edit-tag-form" class="row g-3 tag-edit-group">
        @method('post')
        @csrf
        <div class="col-7">
            <label for="name" class="form-label">Name</label>
            @error('name')
            <span class="invalid-name" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="text" class="form-control" name="name" id="name" value="{{ $tag->name }}" required>
        </div>
    </form>

    <a href="/admin/tags/list" type="button" class="btn btn-primary">Back</a>
    @if($action === \App\Http\Controllers\Admin\TagController::ACTION_EDIT)
        <button type="submit" value="Update" form="edit-tag-form" class="btn btn-success">Update</button>
        <a href="/admin/tags/delete/{{ $tag->id }}}" class="btn btn-danger">Delete</a>
    @else
        <button type="submit" value="Create" form="edit-tag-form" class="btn btn-success">Create</button>
    @endif

@endsection
