@extends('admin.layouts.admin')

@section('content')
    <h1 class="study-list-title">Study sites list</h1>

    <a href="/admin/study/list" type="button" class="btn btn-primary">Back</a>
    <a href="{{ route('admin-study-create-site', $topicId) }}" type="button" class="btn btn-success">Add site</a>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Image</th>
            <th scope="col">Link</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($sites as $site)
            <tr>
                <th scope="row">{{ $site->id }}</th>
                <td><a href="{{ route('admin-study-edit-site', $site->id) }}">{{ $site->title }}</a></td>
                <td>{{ substr($site->description, 0, 30) }}</td>
                <td>{{ $site->image }}</td>
                <td>{{ $site->link }}</td>
                <td>{{ $site->created_at }}</td>
                <td>{{ $site->updated_at }}</td>
                <td>
                    <a href="{{ route('admin-study-remove-site', $site->id) }}">Remove</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $sites->links('admin.layouts.paginationlinks') }}
@endsection
