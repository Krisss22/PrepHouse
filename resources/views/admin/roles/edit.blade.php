@extends('admin.layouts.admin')

@section('content')
    <h1>Role {{ $role->id ?? '' }}</h1>

    <form method="post" action="/admin/roles/{{ $action }}{{ $role->id ? '/' . $role->id : '' }}" id="edit-role-form" class="row g-3 content-edit-group">
        @method('post')
        @csrf

        <div class="col-7 role-section">
            <label for="name" class="form-label fs-3">Role name</label>
            @error('name')
            <span class="invalid-name" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="text" class="form-control" name="name" id="name" value="{{ $role->name }}" required>
        </div>

        @foreach ($rolesList as $roleName)
            <div class="col-7 row role-section">
                <label for="name" class="form-label fs-3">{{ str_replace('_', ' ', ucfirst($roleName)) }} permissions</label>
                @error($role . '_permissions')
                <span class="invalid-name" role="alert">
                <strong>{{ $message }}</strong>
            </span>
                @enderror
                <div class="col-3">
                    <label>Show access</label>
                    <select class="access-select" data-access-type="{{ \App\Models\Role::showAccessType }}">
                        <option {{ $role->getSectorAccess($roleName, \App\Models\Role::showAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                        <option {{ $role->getSectorAccess($roleName, \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                        <option {{ $role->getSectorAccess($roleName, \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                        <option {{ $role->getSectorAccess($roleName, \App\Models\Role::showAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                    </select>
                </div>
                <div class="col-3">
                    <label>Create access</label>
                    <select class="access-select" data-access-type="{{ \App\Models\Role::createAccessType }}">
                        <option {{ $role->getSectorAccess($roleName, \App\Models\Role::createAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                        <option {{ $role->getSectorAccess($roleName, \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                        <option {{ $role->getSectorAccess($roleName, \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                        <option {{ $role->getSectorAccess($roleName, \App\Models\Role::createAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                    </select>
                </div>
                <div class="col-3">
                    <label>Update access</label>
                    <select class="access-select" data-access-type="{{ \App\Models\Role::updateAccessType }}">
                        <option {{ $role->getSectorAccess($roleName, \App\Models\Role::updateAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                        <option {{ $role->getSectorAccess($roleName, \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                        <option {{ $role->getSectorAccess($roleName, \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                        <option {{ $role->getSectorAccess($roleName, \App\Models\Role::updateAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                    </select>
                </div>
                <div class="col-3">
                    <label>Delete access</label>
                    <select class="access-select" data-access-type="{{ \App\Models\Role::deleteAccessType }}">
                        <option {{ $role->getSectorAccess($roleName, \App\Models\Role::deleteAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                        <option {{ $role->getSectorAccess($roleName, \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                        <option {{ $role->getSectorAccess($roleName, \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                        <option {{ $role->getSectorAccess($roleName, \App\Models\Role::deleteAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                    </select>
                </div>
                <input type="text" class="form-control hidden" name="{{ $roleName }}_permissions" id="{{ $roleName }}_permissions" value="{{ $role->getSectorAccess($roleName) }}" required>
            </div>
        @endforeach
    </form>

    <a href="/admin/roles/list" type="button" class="btn btn-primary">Back</a>
    @if($action === \App\Http\Controllers\Admin\AdminController::ACTION_EDIT)
        <button type="submit" value="Update" form="edit-role-form" class="btn btn-success">Update</button>
        <a href="/admin/roles/delete/{{ $role->id }}}" class="btn btn-danger">Delete</a>
    @else
        <button type="submit" value="Create" form="edit-role-form" class="btn btn-success">Create</button>
    @endif

@endsection
