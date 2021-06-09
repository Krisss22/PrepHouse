@extends('admin.layouts.admin')

@section('content')
    <h1 class="questions-list-title">Questions</h1>

    <p>
        <a class="btn btn-secondary" data-bs-toggle="collapse" href="#filterCollapse" role="button" aria-expanded="false" aria-controls="filterCollapse">
            Filter params
        </a>
    </p>
    <div class="collapse" id="filterCollapse">
        <div class="card card-body list-filter">
            <form method="get" class="row">
                @csrf
                <div class="col-2">
                    <label for="" class="form-label">Tags</label>
                    <div class="search-select-element">
                        <input type="text" class="form-control search-select-input" value="{{ $filter['inputTagName'] }}">
                        <input type="text" class="search-select-input-hidden" name="inputTag" value="{{ $filter['inputTag'] }}">
                        <div class="search-select-results">
                            @foreach($tags as $tag)
                                <div data-tag-id="{{ $tag->id }}" class="search-select-results-item search-select-results-item-hidden">{{ $tag->name }}</div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-2">
                    <label for="inputRelease" class="form-label">In release</label>
                    <select name="inputRelease" id="inputRelease" class="form-select">
                        <option value="empty">No filter</option>
                        <option value="0" {{ $filter['inputRelease'] === 0 ? 'selected' : '' }}>No</option>
                        <option value="1" {{ $filter['inputRelease'] === 1 ? 'selected' : '' }}>Yes</option>
                    </select>
                </div>
                <div class="col-2">
                    <label for="inputAddedByAdmin" class="form-label">Added by admin</label>
                    <select name="inputAddedByAdmin" id="inputAddedByAdmin" class="form-select">
                        <option value="empty">No filter</option>
                        <option value="0" {{ $filter['inputAddedByAdmin'] === "0" ? 'selected' : '' }}>No</option>
                        <option value="1" {{ $filter['inputAddedByAdmin'] === "1" ? 'selected' : '' }}>Yes</option>
                    </select>
                </div>
                <div class="list-filter-actions col-12">
                    <input type="submit" class="btn btn-info" name="inputAction" value="Filter">
                    <input type="submit" class="btn btn-danger" name="inputAction" value="Clear">
                </div>
            </form>
        </div>
    </div>

    <a href="/admin/questions/create" class="btn btn-primary">Create question</a>

    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Tag</th>
            <th scope="col">Question</th>
            <th scope="col">In release</th>
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($questions as $question)
            <tr>
                <th scope="row">{{ $question->id }}</th>
                <td><a href="/admin/questions/show/{{ $question->id }}">{{ $question->tag_id ? $question->tag->name : '' }}</a></td>
                <td><a href="/admin/questions/show/{{ $question->id }}">{{ $question->question }}</a></td>
                <td><a href="/admin/questions/show/{{ $question->id }}">{{ $question->isReleased() ? 'Yes' : 'No' }}</a></td>
                <td><a href="/admin/questions/show/{{ $question->id }}">{{ $question->created_at }}</a></td>
                <td><a href="/admin/questions/show/{{ $question->id }}">{{ $question->updated_at }}</a></td>
                <td>
                    <a href="/admin/questions/edit/{{ $question->id }}">Edit</a>
                    <a href="/admin/questions/delete/{{ $question->id }}">Delete</a>
                    @if(!$question->isReleased())
                        <a href="/admin/questions/release/{{ $question->id }}">Release</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $questions->links('admin.layouts.paginationlinks') }}
@endsection
