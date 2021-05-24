@extends('admin.layouts.admin')

@section('content')
    <h1>Vacancy {{ $vacancy->id }}</h1>

    <ul class="list-group content-show-group">
        <li class="list-group-item">ID: {{ $vacancy->id }}</li>
        <li class="list-group-item">Job vacancy: {{ $vacancy->name }}</li>
        <li class="list-group-item">Created at: {{ $vacancy->created_at }}</li>
        <li class="list-group-item">Updated at: {{ $vacancy->updated_at }}</li>
    </ul>

    <a href="/admin/vacancies/list" type="button" class="btn btn-primary">Back</a>
@endsection
