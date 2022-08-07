@extends('admin.layouts.admin')

@section('content')
    <h1 class="tags-list-title">Landings</h1>
    <form method="POST" action="/admin/landings/create" class="row">
        @method('post')
        @csrf
        <div class="col-2">
            <input type="text" name="name" class="form-control">
        </div>
        <div class="col-2">
            <input type="submit" name="submit" value="Create Landing" class="btn btn-primary">
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
        @foreach($landings as $landing)
            <tr>
                <th scope="row">{{ $landing->id }}</th>
                <td>{{ $landing->name }}</td>
                <td>{{ $landing->active ? "yes" : "no" }}</td>
                <td>{{ $landing->created_at }}</td>
                <td>{{ $landing->updated_at }}</td>
                <td>
                    <a href="/admin/landings/changeActive/{{ $landing->id }}/{{ $landing->active ? "disable" : "enable" }}">{{ $landing->active ? "Disable" : "Enable" }}</a>
                    <a href="/admin/landings/edit/{{ $landing->id }}">Edit</a>
                    <a href="/admin/landings/delete/{{ $landing->id }}">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $landings->links('admin.layouts.paginationlinks') }}
@endsection
