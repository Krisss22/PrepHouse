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

        <div class="col-7 row role-section">
            <label for="name" class="form-label fs-3">Roles permissions</label>
            @error('roles_permissions')
            <span class="invalid-name" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="col-3">
                <label>Show access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::showAccessType }}">
                    <option {{ $role->getSectorAccess('roles', \App\Models\Role::showAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('roles', \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('roles', \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('roles', \App\Models\Role::showAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Create access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::createAccessType }}">
                    <option {{ $role->getSectorAccess('roles', \App\Models\Role::createAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('roles', \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('roles', \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('roles', \App\Models\Role::createAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Update access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::updateAccessType }}">
                    <option {{ $role->getSectorAccess('roles', \App\Models\Role::updateAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('roles', \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('roles', \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('roles', \App\Models\Role::updateAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Delete access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::deleteAccessType }}">
                    <option {{ $role->getSectorAccess('roles', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('roles', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('roles', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('roles', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <input type="text" class="form-control hidden" name="roles_permissions" id="roles_permissions" value="{{ $role->getSectorAccess('roles') }}" required>
        </div>

        <div class="col-7 row role-section">
            <label for="name" class="form-label fs-3">Users permissions</label>
            @error('users_permissions')
            <span class="invalid-name" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="col-3">
                <label>Show access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::showAccessType }}">
                    <option {{ $role->getSectorAccess('users', \App\Models\Role::showAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('users', \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('users', \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('users', \App\Models\Role::showAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Create access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::createAccessType }}">
                    <option {{ $role->getSectorAccess('users', \App\Models\Role::createAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('users', \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('users', \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('users', \App\Models\Role::createAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Update access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::updateAccessType }}">
                    <option {{ $role->getSectorAccess('users', \App\Models\Role::updateAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('users', \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('users', \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('users', \App\Models\Role::updateAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Delete access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::deleteAccessType }}">
                    <option {{ $role->getSectorAccess('users', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('users', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('users', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('users', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <input type="text" class="form-control hidden" name="users_permissions" id="users_permissions" value="{{ $role->getSectorAccess('users') }}" required>
        </div>

        <div class="col-7 row role-section">
            <label for="topics" class="form-label fs-3">Topics permissions</label>
            @error('topics_permissions')
            <span class="invalid-name" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="col-3">
                <label>Show access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::showAccessType }}">
                    <option {{ $role->getSectorAccess('topics', \App\Models\Role::showAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('topics', \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('topics', \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('topics', \App\Models\Role::showAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Create access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::createAccessType }}">
                    <option {{ $role->getSectorAccess('topics', \App\Models\Role::createAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('topics', \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('topics', \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('topics', \App\Models\Role::createAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Update access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::updateAccessType }}">
                    <option {{ $role->getSectorAccess('topics', \App\Models\Role::updateAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('topics', \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('topics', \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('topics', \App\Models\Role::updateAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Delete access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::deleteAccessType }}">
                    <option {{ $role->getSectorAccess('topics', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('topics', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('topics', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('topics', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <input type="text" class="form-control hidden" name="topics_permissions" id="topics_permissions" value="{{ $role->getSectorAccess('topics') }}" required>
        </div>

        <div class="col-7 row role-section">
            <label for="tags" class="form-label fs-3">Tags permissions</label>
            @error('tags_permissions')
            <span class="invalid-name" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="col-3">
                <label>Show access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::showAccessType }}">
                    <option {{ $role->getSectorAccess('tags', \App\Models\Role::showAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('tags', \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('tags', \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('tags', \App\Models\Role::showAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Create access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::createAccessType }}">
                    <option {{ $role->getSectorAccess('tags', \App\Models\Role::createAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('tags', \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('tags', \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('tags', \App\Models\Role::createAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Update access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::updateAccessType }}">
                    <option {{ $role->getSectorAccess('tags', \App\Models\Role::updateAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('tags', \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('tags', \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('tags', \App\Models\Role::updateAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Delete access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::deleteAccessType }}">
                    <option {{ $role->getSectorAccess('tags', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('tags', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('tags', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('tags', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <input type="text" class="form-control hidden" name="tags_permissions" id="tags_permissions" value="{{ $role->getSectorAccess('tags') }}" required>
        </div>

        <div class="col-7 row role-section">
            <label for="questions" class="form-label fs-3">Questions permissions</label>
            @error('questions_permissions')
            <span class="invalid-name" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="col-3">
                <label>Show access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::showAccessType }}">
                    <option {{ $role->getSectorAccess('questions', \App\Models\Role::showAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('questions', \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('questions', \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('questions', \App\Models\Role::showAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Create access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::createAccessType }}">
                    <option {{ $role->getSectorAccess('questions', \App\Models\Role::createAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('questions', \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('questions', \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('questions', \App\Models\Role::createAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Update access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::updateAccessType }}">
                    <option {{ $role->getSectorAccess('questions', \App\Models\Role::updateAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('questions', \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('questions', \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('questions', \App\Models\Role::updateAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Delete access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::deleteAccessType }}">
                    <option {{ $role->getSectorAccess('questions', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('questions', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('questions', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('questions', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <input type="text" class="form-control hidden" name="questions_permissions" id="questions_permissions" value="{{ $role->getSectorAccess('questions') }}" required>
        </div>

        <div class="col-7 row role-section">
            <label for="name" class="form-label fs-3">Quizzes permissions</label>
            @error('quizzes_permissions')
            <span class="invalid-name" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="col-3">
                <label>Show access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::showAccessType }}">
                    <option {{ $role->getSectorAccess('quizzes', \App\Models\Role::showAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('quizzes', \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('quizzes', \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('quizzes', \App\Models\Role::showAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Create access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::createAccessType }}">
                    <option {{ $role->getSectorAccess('quizzes', \App\Models\Role::createAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('quizzes', \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('quizzes', \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('quizzes', \App\Models\Role::createAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Update access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::updateAccessType }}">
                    <option {{ $role->getSectorAccess('quizzes', \App\Models\Role::updateAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('quizzes', \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('quizzes', \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('quizzes', \App\Models\Role::updateAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Delete access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::deleteAccessType }}">
                    <option {{ $role->getSectorAccess('quizzes', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('quizzes', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('quizzes', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('quizzes', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <input type="text" class="form-control hidden" name="quizzes_permissions" id="quizzes_permissions" value="{{ $role->getSectorAccess('quizzes') }}" required>
        </div>

        <div class="col-7 row role-section">
            <label for="name" class="form-label fs-3">Study books permissions</label>
            @error('study_books_permissions')
            <span class="invalid-name" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="col-3">
                <label>Show access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::showAccessType }}">
                    <option {{ $role->getSectorAccess('study_books', \App\Models\Role::showAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('study_books', \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('study_books', \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('study_books', \App\Models\Role::showAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Create access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::createAccessType }}">
                    <option {{ $role->getSectorAccess('study_books', \App\Models\Role::createAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('study_books', \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('study_books', \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('study_books', \App\Models\Role::createAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Update access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::updateAccessType }}">
                    <option {{ $role->getSectorAccess('study_books', \App\Models\Role::updateAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('study_books', \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('study_books', \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('study_books', \App\Models\Role::updateAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Delete access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::deleteAccessType }}">
                    <option {{ $role->getSectorAccess('study_books', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('study_books', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('study_books', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('study_books', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <input type="text" class="form-control hidden" name="study_books_permissions" id="study_books_permissions" value="{{ $role->getSectorAccess('study_books') }}" required>
        </div>

        <div class="col-7 row role-section">
            <label for="name" class="form-label fs-3">Study materials permissions</label>
            @error('study_materials_permissions')
            <span class="invalid-name" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="col-3">
                <label>Show access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::showAccessType }}">
                    <option {{ $role->getSectorAccess('study_materials', \App\Models\Role::showAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('study_materials', \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('study_materials', \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('study_materials', \App\Models\Role::showAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Create access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::createAccessType }}">
                    <option {{ $role->getSectorAccess('study_materials', \App\Models\Role::createAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('study_materials', \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('study_materials', \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('study_materials', \App\Models\Role::createAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Update access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::updateAccessType }}">
                    <option {{ $role->getSectorAccess('study_materials', \App\Models\Role::updateAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('study_materials', \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('study_materials', \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('study_materials', \App\Models\Role::updateAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Delete access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::deleteAccessType }}">
                    <option {{ $role->getSectorAccess('study_materials', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('study_materials', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('study_materials', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('study_materials', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <input type="text" class="form-control hidden" name="study_materials_permissions" id="study_materials_permissions" value="{{ $role->getSectorAccess('study_materials') }}" required>
        </div>

        <div class="col-7 row role-section">
            <label for="name" class="form-label fs-3">Study videos permissions</label>
            @error('study_videos_permissions')
            <span class="invalid-name" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="col-3">
                <label>Show access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::showAccessType }}">
                    <option {{ $role->getSectorAccess('study_videos', \App\Models\Role::showAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('study_videos', \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('study_videos', \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('study_videos', \App\Models\Role::showAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Create access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::createAccessType }}">
                    <option {{ $role->getSectorAccess('study_videos', \App\Models\Role::createAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('study_videos', \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('study_videos', \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('study_videos', \App\Models\Role::createAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Update access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::updateAccessType }}">
                    <option {{ $role->getSectorAccess('study_videos', \App\Models\Role::updateAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('study_videos', \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('study_videos', \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('study_videos', \App\Models\Role::updateAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Delete access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::deleteAccessType }}">
                    <option {{ $role->getSectorAccess('study_videos', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('study_videos', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('study_videos', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('study_videos', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <input type="text" class="form-control hidden" name="study_videos_permissions" id="study_videos_permissions" value="{{ $role->getSectorAccess('study_videos') }}" required>
        </div>

        <div class="col-7 row role-section">
            <label for="name" class="form-label fs-3">Study sites permissions</label>
            @error('study_sites_permissions')
            <span class="invalid-name" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="col-3">
                <label>Show access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::showAccessType }}">
                    <option {{ $role->getSectorAccess('study_sites', \App\Models\Role::showAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('study_sites', \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('study_sites', \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('study_sites', \App\Models\Role::showAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Create access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::createAccessType }}">
                    <option {{ $role->getSectorAccess('study_sites', \App\Models\Role::createAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('study_sites', \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('study_sites', \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('study_sites', \App\Models\Role::createAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Update access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::updateAccessType }}">
                    <option {{ $role->getSectorAccess('study_sites', \App\Models\Role::updateAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('study_sites', \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('study_sites', \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('study_sites', \App\Models\Role::updateAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Delete access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::deleteAccessType }}">
                    <option {{ $role->getSectorAccess('study_sites', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('study_sites', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('study_sites', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('study_sites', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <input type="text" class="form-control hidden" name="study_sites_permissions" id="study_sites_permissions" value="{{ $role->getSectorAccess('study_sites') }}" required>
        </div>

        <div class="col-7 row role-section">
            <label for="name" class="form-label fs-3">Vacancies permissions</label>
            @error('vacancies_permissions')
            <span class="invalid-name" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="col-3">
                <label>Show access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::showAccessType }}">
                    <option {{ $role->getSectorAccess('vacancies', \App\Models\Role::showAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('vacancies', \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('vacancies', \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('vacancies', \App\Models\Role::showAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Create access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::createAccessType }}">
                    <option {{ $role->getSectorAccess('vacancies', \App\Models\Role::createAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('vacancies', \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('vacancies', \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('vacancies', \App\Models\Role::createAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Update access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::updateAccessType }}">
                    <option {{ $role->getSectorAccess('vacancies', \App\Models\Role::updateAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('vacancies', \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('vacancies', \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('vacancies', \App\Models\Role::updateAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Delete access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::deleteAccessType }}">
                    <option {{ $role->getSectorAccess('vacancies', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('vacancies', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('vacancies', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('vacancies', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <input type="text" class="form-control hidden" name="vacancies_permissions" id="vacancies_permissions" value="{{ $role->getSectorAccess('vacancies') }}" required>
        </div>

        <div class="col-7 row role-section">
            <label for="name" class="form-label fs-3">Sent questions permissions</label>
            @error('sent_questions_permissions')
            <span class="invalid-name" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="col-3">
                <label>Show access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::showAccessType }}">
                    <option {{ $role->getSectorAccess('sent_questions', \App\Models\Role::showAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('sent_questions', \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('sent_questions', \App\Models\Role::showAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('sent_questions', \App\Models\Role::showAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Create access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::createAccessType }}">
                    <option {{ $role->getSectorAccess('sent_questions', \App\Models\Role::createAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('sent_questions', \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('sent_questions', \App\Models\Role::createAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('sent_questions', \App\Models\Role::createAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Update access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::updateAccessType }}">
                    <option {{ $role->getSectorAccess('sent_questions', \App\Models\Role::updateAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('sent_questions', \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('sent_questions', \App\Models\Role::updateAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('sent_questions', \App\Models\Role::updateAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <div class="col-3">
                <label>Delete access</label>
                <select class="access-select" data-access-type="{{ \App\Models\Role::deleteAccessType }}">
                    <option {{ $role->getSectorAccess('sent_questions', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessDenied ? 'selected' : '' }} value="{{ \App\Models\Role::accessDenied }}">Denied</option>
                    <option {{ $role->getSectorAccess('sent_questions', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMe ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMe }}">Only user</option>
                    <option {{ $role->getSectorAccess('sent_questions', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessOnlyMyRole ? 'selected' : '' }} value="{{ \App\Models\Role::accessOnlyMyRole }}">Only user role</option>
                    <option {{ $role->getSectorAccess('sent_questions', \App\Models\Role::deleteAccessType) === \App\Models\Role::accessAll ? 'selected' : '' }} value="{{ \App\Models\Role::accessAll }}">All</option>
                </select>
            </div>
            <input type="text" class="form-control hidden" name="sent_questions_permissions" id="sent_questions_permissions" value="{{ $role->getSectorAccess('sent_questions') }}" required>
        </div>
    </form>

    <a href="/admin/roles/list" type="button" class="btn btn-primary">Back</a>
    @if($action === \App\Http\Controllers\Admin\AdminController::ACTION_EDIT)
        <button type="submit" value="Update" form="edit-role-form" class="btn btn-success">Update</button>
        <a href="/admin/roles/delete/{{ $role->id }}}" class="btn btn-danger">Delete</a>
    @else
        <button type="submit" value="Create" form="edit-role-form" class="btn btn-success">Create</button>
    @endif

@endsection
