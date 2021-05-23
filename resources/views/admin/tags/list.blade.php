@extends('admin.layouts.admin')

@section('content')
    <h1 class="tags-list-title">Vacancies</h1>
    <form method="POST" action="/admin/tags/create" class="row">
        @method('post')
        @csrf
        <div class="col-2">
            <input type="text" name="name" class="form-control">
        </div>
        <div class="col-2">
            <input type="submit" name="submit" value="Create Tag" class="btn btn-primary">
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
        @foreach($tags as $tag)
            <tr>
                <th scope="row">{{ $tag->id }}</th>
                <td>{{ $tag->name }}</td>
                <td>{{ $tag->created_at }}</td>
                <td>{{ $tag->updated_at }}</td>
                <td>
                    <a href="/admin/tags/edit/{{ $tag->id }}">Edit</a>
                    <a href="/admin/tags/delete/{{ $tag->id }}">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $tags->links('admin.layouts.paginationlinks') }}
@endsection
