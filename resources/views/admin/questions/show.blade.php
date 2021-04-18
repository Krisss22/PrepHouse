@extends('admin.layouts.admin')

@section('content')
    <h1>Question {{ $question->id }}</h1>

    <ul class="list-group question-show-group">
        <li class="list-group-item">ID: {{ $question->id }}</li>
        <li class="list-group-item">Job vacancy: {{ $question->job_vacancy }}</li>
        <li class="list-group-item">Question: {{ $question->question }}</li>
        <li class="list-group-item">Created at: {{ $question->created_at }}</li>
        <li class="list-group-item">Updated at: {{ $question->updated_at }}</li>
    </ul>

    <a type="button" onclick="javascript:history.back();return false;" class="btn btn-primary">Back</a>
@endsection
