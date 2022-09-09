@extends('admin.layouts.admin')

@section('content')
    <h1>Vacancy {{ $expertiseArea->id }}</h1>

    <form method="post" action="/admin/expertise-areas/{{ $action }}{{ $expertiseArea->id ? '/' . $expertiseArea->id : '' }}" id="edit-expertise-areas-form" class="row g-3 content-edit-group">
        @method('post')
        @csrf
        <div class="col-7">
            <label for="name" class="form-label">Name</label>
            @error('name')
            <span class="invalid-name" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="text" class="form-control" name="name" id="name" value="{{ $expertiseArea->name }}" required>
        </div>


        <div class="col-7 form-check form-switch">
            <label for="active" class="form-label">Active</label>
            @error('active')
            <span class="invalid-active" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="checkbox" class="form-check-input" name="active" id="active" @if($expertiseArea->active) checked @endIf">
        </div>
    </form>

    <a href="/admin/expertise-areas/list" type="button" class="btn btn-primary">Back</a>
    @if($action === \App\Http\Controllers\Admin\ExpertiseAreaController::ACTION_EDIT)
        <button type="submit" value="Update" form="edit-expertise-areas-form" class="btn btn-success">Update</button>
        <a href="/admin/expertise-areas/delete/{{ $expertiseArea->id }}}" class="btn btn-danger">Delete</a>
    @else
        <button type="submit" value="Create" form="edit-expertise-areas-form" class="btn btn-success">Create</button>
    @endif

@endsection
