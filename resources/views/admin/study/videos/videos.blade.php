@extends('admin.layouts.admin')

@section('content')
    <h1 class="study-list-title">Study videos list</h1>

    <a href="/admin/study/list" type="button" class="btn btn-primary">Back</a>
    <a href="{{ route('admin-study-create-video', $topicId) }}" type="button" class="btn btn-success">Add video</a>

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
        @foreach($videos as $video)
            <tr>
                <th scope="row">{{ $video->id }}</th>
                <td><a href="{{ route('admin-study-edit-video', $video->id) }}">{{ $video->title }}</a></td>
                <td>{{ substr($video->description, 0, 30) }}</td>
                <td>{{ $video->image }}</td>
                <td>{{ $video->link }}</td>
                <td>{{ $video->created_at }}</td>
                <td>{{ $video->updated_at }}</td>
                <td>
                    <a href="{{ route('admin-study-remove-video', $video->id) }}">Remove</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $videos->links('admin.layouts.paginationlinks') }}
@endsection
