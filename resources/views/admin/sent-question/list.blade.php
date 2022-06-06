@extends('admin.layouts.admin')

@section('content')
    <h1 class="sent-questions-list-title">Sent questions</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Question</th>
            <th scope="col">Answer</th>
            <th scope="col">Email</th>
            <th scope="col">Need feedback</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sentQuestions as $sentQuestion)
            <tr>
                <th scope="row">{{ $sentQuestion->id }}</th>
                <td><a href="/admin/sent-questions/show/{{ $sentQuestion->id }}">{{ $sentQuestion->title }}</a></td>
                <td class="questions-list-question-td"><a href="/admin/sent-questions/show/{{ $sentQuestion->id }}">{{ $sentQuestion->question }}</a></td>
                <td><a href="/admin/sent-questions/show/{{ $sentQuestion->id }}">{{ $sentQuestion->answer }}</a></td>
                <td><a href="/admin/sent-questions/show/{{ $sentQuestion->id }}">{{ $sentQuestion->email }}</a></td>
                <td><a href="/admin/sent-questions/show/{{ $sentQuestion->id }}">{{ $sentQuestion->needFeedback() ? 'Yes' : 'No' }}</a></td>
                <td><a href="/admin/sent-questions/show/{{ $sentQuestion->id }}">{{ $sentQuestion->created_at }}</a></td>
                <td><a href="/admin/sent-questions/show/{{ $sentQuestion->id }}">{{ $sentQuestion->updated_at }}</a></td>
                <td>
                    <a href="/admin/sent-questions/delete/{{ $sentQuestion->id }}">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $sentQuestions->links('admin.layouts.paginationlinks') }}
@endsection
