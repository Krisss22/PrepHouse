@extends('admin.layouts.admin')

@section('content')
    <h1>Question {{ $sentQuestion->id }}</h1>

    <ul class="list-group content-show-group">
        <li class="list-group-item">ID: {{ $sentQuestion->id }}</li>
        <li class="list-group-item">Title: {{ $sentQuestion->title }}</li>
        <li class="list-group-item">Question: {{ $sentQuestion->question }}</li>
        <li class="list-group-item">Answer: {{ $sentQuestion->answer }}</li>
        <li class="list-group-item">Email: {{ $sentQuestion->email }}</li>
        <li class="list-group-item">Created at: {{ $sentQuestion->created_at }}</li>
        <li class="list-group-item">Updated at: {{ $sentQuestion->updated_at }}</li>
    </ul>

    <a href="/admin/sent-questions/list" type="button" class="btn btn-primary">Back</a>
@endsection
