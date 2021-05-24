@extends('admin.layouts.admin')

@section('content')
    <h1>User {{ $user->id }}</h1>

    <form method="post" action="/admin/users/edit/{{ $user->id }}" id="edit-user-form" class="row g-3 content-edit-group">
        @method('post')
        @csrf
        <div class="col-7">
            <label for="inputName" class="form-label">Name</label>
            @error('inputName')
            <span class="invalid-inputName" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="text" class="form-control" name="inputName" id="inputName" value="{{ $user->name }}" required>
        </div>
        <div class="col-7">
            <label for="inputEmail" class="form-label">Email</label>
            @error('inputEmail')
            <span class="invalid-inputEmail" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="text" class="form-control" name="inputEmail" id="inputEmail" value="{{ $user->email }}" required>
        </div>
        <div class="col-7">
            <label for="inputRole" class="form-label">Email</label>
            <select id="inputRole" name="inputRole" class="form-select">
                <option value="0">User</option>
                <option value="1">Admin</option>
            </select>
        </div>
    </form>

    <a href="/admin/users/list" type="button" class="btn btn-primary">Back</a>
    <button type="submit" value="Update" form="edit-user-form" class="btn btn-success">Update</button>
    <a href="/admin/users/delete/{{ $user->id }}}" class="btn btn-danger">Delete</a>
@endsection
