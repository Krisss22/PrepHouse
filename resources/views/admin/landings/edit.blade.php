@extends('admin.layouts.admin')

@section('content')
    <h1>Landing {{ $landing->name }}</h1>

    <form method="post" action="/admin/landings/edit/{{ $landing->id }}" id="edit-landing-form" class="row g-3 content-edit-group">
        @method('post')
        @csrf
        <div class="col-7">
            <label for="name" class="form-label">Name</label>
            @error('name')
            <span class="invalid-name" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="text" class="form-control" name="name" id="name" value="{{ $landing->name }}" required>
        </div>
        <div class="col-7">
            <label for="active" class="form-label">Active</label>
            @error('name')
            <span class="invalid-active" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <br>
            <input type="checkbox" name="active" id="active" @if($landing->active) checked @endIf">
        </div>
    </form>

    <a href="/admin/landings/list" type="button" class="btn btn-primary">Back</a>

    <button type="submit" value="Update" form="edit-landing-form" class="btn btn-success">Update</button>
    <a href="/admin/landings/delete/{{ $landing->id }}}" class="btn btn-danger">Delete</a>
@endsection
