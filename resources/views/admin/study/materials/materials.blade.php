@extends('admin.layouts.admin')

@section('content')
    <h1 class="study-list-title">Study materials list</h1>

    <a href="/admin/study/list" type="button" class="btn btn-primary">Back</a>
    <a href="{{ route('admin-study-create-material', $topicId) }}" type="button" class="btn btn-success">Add material</a>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Image</th>
            <th scope="col">File</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($materials as $material)
            <tr>
                <th scope="row">{{ $material->id }}</th>
                <td><a href="{{ route('admin-study-edit-material', $material->id) }}">{{ $material->title }}</a></td>
                <td>{{ $material->image }}</td>
                <td>{{ $material->file }}</td>
                <td>{{ $material->created_at }}</td>
                <td>{{ $material->updated_at }}</td>
                <td>
                    <a href="{{ route('admin-study-remove-material', $material->id) }}">Remove</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $materials->links('admin.layouts.paginationlinks') }}
@endsection
