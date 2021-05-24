@extends('admin.layouts.admin')

@section('content')
    <h1 class="topics-list-title">Topics</h1>
    <form method="POST" action="/admin/topics/create" class="row">
        @method('post')
        @csrf
        <div class="col-2">
            <input type="text" name="name" class="form-control">
        </div>
        <div class="col-2">
            <input type="submit" name="submit" value="Create Topic" class="btn btn-primary">
        </div>
    </form>

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
        @foreach($topics as $topic)
            <tr>
                <th scope="row">{{ $topic->id }}</th>
                <td>{{ $topic->name }}</td>
                <td>{{ $topic->created_at }}</td>
                <td>{{ $topic->updated_at }}</td>
                <td>
                    <a href="/admin/topics/edit/{{ $topic->id }}">Edit</a>
                    <a href="/admin/topics/delete/{{ $topic->id }}">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $topics->links('admin.layouts.paginationlinks') }}
@endsection
