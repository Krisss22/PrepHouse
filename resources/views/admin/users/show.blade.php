@extends('admin.layouts.admin')

@section('content')
    <h1>Question {{ $user->id }}</h1>

    <ul class="list-group user-show-group">
        <li class="list-group-item">ID: {{ $user->id }}</li>
        <li class="list-group-item">Name: {{ $user->name }}</li>
        <li class="list-group-item">Email: {{ $user->email }}</li>
        <li class="list-group-item">Role: {{ $user->role }}</li>
        <li class="list-group-item">Created at: {{ $user->created_at }}</li>
        <li class="list-group-item">Updated at: {{ $user->updated_at }}</li>
    </ul>

    <a href="/admin/users/list" type="button" class="btn btn-primary">Back</a>
@endsection
