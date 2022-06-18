@extends('admin.layouts.admin')

@section('content')
    <h1 class="users-list-title">Users</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Role</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <th scope="row">{{ $user->id }}</th>
                <td><a href="/admin/users/show/{{ $user->id }}">{{ $user->name }}</a></td>
                <td><a href="/admin/users/show/{{ $user->id }}">{{ $user->email }}</a></td>
                <td><a href="/admin/users/show/{{ $user->id }}">{{ $user->role > 0 ? $user->userRole->name : 'without role' }}</a></td>
                <td><a href="/admin/users/show/{{ $user->id }}">{{ $user->created_at }}</a></td>
                <td><a href="/admin/users/show/{{ $user->id }}">{{ $user->updated_at }}</a></td>
                <td>
                    <a href="/admin/users/edit/{{ $user->id }}">Edit</a>
                    <a href="/admin/users/delete/{{ $user->id }}">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $users->links('admin.layouts.paginationlinks') }}
@endsection
