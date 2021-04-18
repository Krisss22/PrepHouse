@extends('admin.layouts.admin')

@section('content')
    <h1 class="questions-list-title">Questions</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Job vacancy</th>
            <th scope="col">Question</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($questions as $question)
            <tr>
                <th scope="row">{{ $question->id }}</th>
                <td><a href="/admin/questions/show/{{ $question->id }}">{{ $question->job_vacancy }}</a></td>
                <td><a href="/admin/questions/show/{{ $question->id }}">{{ $question->question }}</a></td>
                <td><a href="/admin/questions/show/{{ $question->id }}">{{ $question->created_at }}</a></td>
                <td><a href="/admin/questions/show/{{ $question->id }}">{{ $question->updated_at }}</a></td>
                <td>
                    <a href="/admin/questions/edit/{{ $question->id }}">Edit</a>
                    <a href="/admin/questions/delete/{{ $question->id }}">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $questions->links('admin.layouts.paginationlinks') }}
@endsection
