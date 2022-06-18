@extends('admin.layouts.admin')

@section('content')
    <h1 class="roles-list-title">Roles</h1>

    <a href="/admin/roles/create" class="btn btn-primary">Create new role</a>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($roles as $role)
            <tr>
                <th scope="row">{{ $role->id }}</th>
                <td><a href="/admin/roles/show/{{ $role->id }}">{{ $role->name }}</a></td>
                <td>{{ $role->created_at }}</td>
                <td>{{ $role->updated_at }}</td>
                <td>
                    <a href="/admin/roles/show/{{ $role->id }}">Show</a>
                    <a href="/admin/roles/edit/{{ $role->id }}">Edit</a>
                    <a href="/admin/roles/delete/{{ $role->id }}">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $roles->links('admin.layouts.paginationlinks') }}
@endsection
