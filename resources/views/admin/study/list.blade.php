@extends('admin.layouts.admin')

@section('content')
    <h1 class="study-list-title">Study</h1>

    <h2 class="study-list-title">Topics list</h2>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Videos</th>
            <th scope="col">Books</th>
            <th scope="col">Materials</th>
            <th scope="col">Sites</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
            @foreach($topics as $topic)
                <tr>
                    <th scope="row">{{ $topic->id }}</th>
                    <td><a href="{{ route('admin-study-materials', $topic->id) }}">{{ $topic->name }}</a></td>
                    <td>{{ count($topic->videos) }}</td>
                    <td>{{ count($topic->books) }}</td>
                    <td>{{ count($topic->materials) }}</td>
                    <td>{{ count($topic->sites) }}</td>
                    <td>{{ $topic->created_at }}</td>
                    <td>{{ $topic->updated_at }}</td>
                    <td>
                        <a href="{{ route('admin-study-videos', $topic->id) }}">Open videos</a><br>
                        <a href="{{ route('admin-study-books', $topic->id) }}">Open books</a><br>
                        <a href="{{ route('admin-study-materials', $topic->id) }}">Open materials</a><br>
                        <a href="{{ route('admin-study-sites', $topic->id) }}">Open sites</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $topics->links('admin.layouts.paginationlinks') }}
@endsection
