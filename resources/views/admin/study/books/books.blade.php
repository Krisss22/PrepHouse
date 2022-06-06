@extends('admin.layouts.admin')

@section('content')
    <h1 class="study-list-title">Study books list</h1>

    <a href="/admin/study/list" type="button" class="btn btn-primary">Back</a>
    <a href="{{ route('admin-study-create-book', $topicId) }}" type="button" class="btn btn-success">Add book</a>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Description</th>
            <th scope="col">Image</th>
            <th scope="col">File</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($books as $book)
            <tr>
                <th scope="row">{{ $book->id }}</th>
                <td><a href="{{ route('admin-study-edit-book', $book->id) }}">{{ $book->title }}</a></td>
                <td>{{ $book->author }}</td>
                <td>{{ substr($book->description, 0, 30) }}</td>
                <td>{{ $book->image }}</td>
                <td>{{ $book->file }}</td>
                <td>{{ $book->created_at }}</td>
                <td>{{ $book->updated_at }}</td>
                <td>
                    <a href="{{ route('admin-study-remove-book', $book->id) }}">Remove</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $books->links('admin.layouts.paginationlinks') }}
@endsection
