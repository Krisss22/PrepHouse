@extends('admin.layouts.admin')

@section('content')
    <h1 class="questions-list-title">Vacancies</h1>
    <a href="/admin/vacancies/create" class="btn btn-primary">Create Vacancy</a>

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
        @foreach($vacancies as $vacancy)
            <tr>
                <th scope="row">{{ $vacancy->id }}</th>
                <td><a href="/admin/vacancies/show/{{ $vacancy->id }}">{{ $vacancy->name }}</a></td>
                <td><a href="/admin/vacancies/show/{{ $vacancy->id }}">{{ $vacancy->created_at }}</a></td>
                <td><a href="/admin/vacancies/show/{{ $vacancy->id }}">{{ $vacancy->updated_at }}</a></td>
                <td>
                    <a href="/admin/vacancies/edit/{{ $vacancy->id }}">Edit</a>
                    <a href="/admin/vacancies/delete/{{ $vacancy->id }}">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $vacancies->links('admin.layouts.paginationlinks') }}
@endsection
