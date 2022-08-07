@extends('admin.layouts.admin')

@section('content')
    <h1>Interview requests</h1>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Text</th>
            <th scope="col">Status</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($interviewRequests as $request)
            <tr>
                <th scope="row">{{ $request->id }}</th>
                <td>{{ $request->name }}</td>
                <td>{{ $request->email }}</td>
                <td>{{ $request->text }}</td>
                <td>{{ $request->getStatusName($request->status) }}</td>
                <td>{{ $request->created_at }}</td>
                <td>{{ $request->updated_at }}</td>
                <td>
                    @if(!$request->isLowestStatus())
                     <a href="interview-requests/change-status/{{ $request->id }}/{{ $request->getLowerStatus() }}">{{ $request->getStatusName($request->getLowerStatus()) }}</a>
                    @endif
                    @if(!$request->isHighestStatus())
                     <a href="interview-requests/change-status/{{ $request->id }}/{{ $request->getHigherStatus() }}">{{ $request->getStatusName($request->getHigherStatus()) }}</a>
                    @endif
                    <a href="interview-requests/delete/{{ $request->id }}">Delete</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $interviewRequests->links('admin.layouts.paginationlinks') }}
@endsection
