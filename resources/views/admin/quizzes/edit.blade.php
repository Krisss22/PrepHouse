@extends('admin.layouts.admin')

@section('content')
    <h1>Quiz {{ $quiz->id }}</h1>

    <form method="post" action="/admin/quizzes/{{ $action }}{{ $quiz->id ? '/' . $quiz->id : '' }}" id="edit-quiz-form" class="row g-3 content-edit-group">
        @method('post')
        @csrf
        <div class="col-7">
            <label for="name" class="form-label">Quiz name</label>
            @error('name')
            <span class="invalid-name" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="text" class="form-control" name="name" id="name" value="{{ $quiz->name }}" required>
        </div>
        <div class="col-7">
            <label for="topic" class="form-label">Topic</label>
            @error('name')
            <span class="invalid-topic" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="search-select-element" data-json-name="topics" data-json-url="/admin/topics/get-json">
                <input type="text" class="form-control search-select-input" value="{{ $quiz->topic ? $quiz->topic->name : '' }}">
                <input type="text" class="search-select-input-hidden" name="topic" id="topic" value="{{ $quiz->topic_id }}" required>
            </div>
        </div>
        <div class="quiz-tag-block">
            @foreach($quiz->quizTags as $quizTag)
                <div class="quiz-tag-block-item">
                    <div class="col-5 quiz-tag-block-item-tag">
                        <label class="form-label">Tag</label> <div class="quiz-tag-block-item-delete">Delete</div>
                        <div class="search-select-element" data-json-name="tags" data-json-url="/admin/tags/get-json">
                            <input type="text" class="form-control search-select-input" value="{{ $quizTag->tag->name }}">
                            <input type="text" class="search-select-input-hidden" name="quizTag[{{ $quizTag->id }}][tagId]" value="{{ $quizTag->tag->id ?? '' }}">
                            <div class="search-select-results">
                                @foreach($tags as $tag)
                                    <div data-tag-id="{{ $tag->id }}" class="search-select-results-item search-select-results-item-hidden">{{ $tag->name }}</div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-1 quiz-tag-block-item-count">
                        <label for="count" class="form-label">Count</label>
                        <input type="number" class="form-control" name="quizTag[{{ $quizTag->id }}][count]" id="count" value="{{ $quizTag->count }}" required>
                    </div>
                </div>
            @endforeach
            <a id="addNewTagInQuiz" class="btn btn-primary">Add tag</a>
        </div>
    </form>

    <a href="/admin/quizzes/list" type="button" class="btn btn-primary">Back</a>
    @if($action === \App\Http\Controllers\Admin\QuizController::ACTION_EDIT)
        <button type="submit" value="Update" form="edit-quiz-form" class="btn btn-success">Update</button>
        <a href="/admin/quizzes/delete/{{ $quiz->id }}}" class="btn btn-danger">Delete</a>
    @else
        <button type="submit" value="Create" form="edit-quiz-form" class="btn btn-success">Create</button>
    @endif

@endsection
