@extends('admin.layouts.admin')

@section('content')
    <h1 class="tags-list-title">Quizzes</h1>

    <a href="/admin/quizzes/create" class="btn btn-primary">Create quiz</a>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Questions</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($quizzes as $quiz)
            <tr>
                <th scope="row">{{ $quiz->id }}</th>
                <td>{{ $quiz->name }}</td>
                <td>{{ $quiz->getAllQuestionsCount() }}</td>
                <td>{{ $quiz->created_at }}</td>
                <td>{{ $quiz->updated_at }}</td>
                <td>
                    <a href="/admin/quizzes/edit/{{ $quiz->id }}">Edit</a>
                    <a href="/admin/quizzes/delete/{{ $quiz->id }}">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $quizzes->links('admin.layouts.paginationlinks') }}
@endsection
