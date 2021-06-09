@extends('admin.layouts.admin')

@section('content')
    <h1>Question {{ $question->id }}</h1>

    <ul class="list-group content-show-group">
        <li class="list-group-item">ID: {{ $question->id }}</li>
        <li class="list-group-item">Question: {{ $question->question }}</li>
        <li class="list-group-item">Answer: {{ $question->answer }}</li>
        <li class="list-group-item">Added by admin: {{ $question->isAddedByAdmin() ? 'Yes' : 'No' }}</li>
        <li class="list-group-item">Released: {{ $question->isReleased() ? 'Yes' : 'No' }}</li>
        <li class="list-group-item">Created at: {{ $question->created_at }}</li>
        <li class="list-group-item">Updated at: {{ $question->updated_at }}</li>
    </ul>

    <a href="/admin/questions/list" type="button" class="btn btn-primary">Back</a>
@endsection
