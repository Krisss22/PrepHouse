@extends('admin.layouts.admin')

@section('content')
    <h1 class="roles-list-title">Role {{ $role->name }}</h1>

    <ul class="list-group content-show-group">
        <li class="list-group-item">ID: {{ $role->id }}</li>
        <li class="list-group-item">Role name: {{ $role->name }}</li>
        <li class="list-group-item">Role sector permissions: {{ $role->roles_permissions }}</li>
        <li class="list-group-item">Users sector permissions: {{ $role->users_permissions }}</li>
        <li class="list-group-item">Topics sector permissions: {{ $role->topics_permissions }}</li>
        <li class="list-group-item">Quizzes sector permissions: {{ $role->quizzes_permissions }}</li>
        <li class="list-group-item">Study books sector permissions: {{ $role->study_books_permissions }}</li>
        <li class="list-group-item">Study materials sector permissions: {{ $role->study_materials_permissions }}</li>
        <li class="list-group-item">Study videos sector permissions: {{ $role->study_videos_permissions }}</li>
        <li class="list-group-item">Study sites sector permissions: {{ $role->study_sites_permissions }}</li>
        <li class="list-group-item">Vacancies sector permissions: {{ $role->vacancies_permissions }}</li>
        <li class="list-group-item">Sent questions sector permissions: {{ $role->sent_questions_permissions }}</li>
        <li class="list-group-item">Created at: {{ $role->created_at }}</li>
        <li class="list-group-item">Updated at: {{ $role->updated_at }}</li>
    </ul>

    <a href="/admin/roles/list" type="button" class="btn btn-primary">Back</a>
@endsection
