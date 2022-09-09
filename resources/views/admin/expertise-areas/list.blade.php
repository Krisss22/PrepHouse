@extends('admin.layouts.admin')

@section('content')
    <h1 class="tags-list-title">Expertise areas</h1>
    <form method="POST" action="/admin/expertise-areas/create" class="row">
        @method('post')
        @csrf
        <div class="col-2">
            <input type="text" name="name" class="form-control">
        </div>
        <div class="col-2">
            <input type="submit" name="submit" value="Create expertise area" class="btn btn-primary">
        </div>
    </form>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Active</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($expertiseAreas as $expertiseArea)
            <tr>
                <th scope="row">{{ $expertiseArea->id }}</th>
                <td>{{ $expertiseArea->name }}</td>
                <td>{{ $expertiseArea->active ? 'true' : 'false' }}</td>
                <td>{{ $expertiseArea->created_at }}</td>
                <td>{{ $expertiseArea->updated_at }}</td>
                <td>
                    <a href="/admin/expertise-areas/change-status/{{ $expertiseArea->id }}/{{ $expertiseArea->active ? 0 : 1 }}">{{ $expertiseArea->active ? 'Disable' : 'Enable' }}</a>
                    <a href="/admin/expertise-areas/edit/{{ $expertiseArea->id }}">Edit</a>
                    <a href="/admin/expertise-areas/delete/{{ $expertiseArea->id }}">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $expertiseAreas->links('admin.layouts.paginationlinks') }}
@endsection
