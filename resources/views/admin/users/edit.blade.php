@extends('admin.layouts.admin')

@section('content')
    <h1>User {{ $user->id ?? 'create' }}</h1>

    <form method="post" action="/admin/users/{{ $action }}{{ $user->id ? '/' . $user->id : '' }}" id="edit-user-form" class="row g-3 content-edit-group">
        @method('post')
        @csrf
        <div class="col-7">
            <label for="name" class="form-label">Name</label>
            @error('name')
            <span class="invalid-inputName" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" required>
        </div>
        <div class="col-7">
            <label for="name" class="form-label">Name</label>
            @error('surname')
            <span class="invalid-surname" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="text" class="form-control" name="surname" id="surname" value="{{ $user->surname }}" required>
        </div>
        <div class="col-7">
            <label for="email" class="form-label">Email</label>
            @error('email')
            <span class="invalid-inputEmail" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}" required>
        </div>
        <div class="col-7">
            <label for="password" class="form-label">Password</label>
            @error('password')
            <span class="invalid-password" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="text" class="form-control" name="password" id="password" value="">
        </div>
        <div class="col-7">
            <label for="role" class="form-label">Role</label>
            <select id="role" name="role" class="form-select">
                @foreach($roles as $role)
                    <option @if($role->id === $user->role) selected @endif value="{{ $role->id }}">{{ $role->name }}</option>
                @endforeach
            </select>
        </div>
    </form>

    <a href="/admin/users/list" type="button" class="btn btn-primary">Back</a>
    @if($action === \App\Http\Controllers\Admin\UserController::ACTION_EDIT)
        <button type="submit" value="Update" form="edit-user-form" class="btn btn-success">Update</button>
        <a href="/admin/users/delete/{{ $user->id }}}" class="btn btn-danger">Delete</a>
    @else
        <button type="submit" value="Create" form="edit-user-form" class="btn btn-success">Create</button>
    @endif
@endsection
