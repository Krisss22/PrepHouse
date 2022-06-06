@extends('admin.layouts.admin')

@section('content')
    <h1>Question {{ $question->id }}</h1>

    <form method="post" action="/admin/questions/{{ $action }}{{ $question->id ? '/' . $question->id : '' }}" id="edit-question-form" enctype="multipart/form-data" class="row g-3 content-edit-group">
        @method('post')
        @csrf
        <div class="col-7">
            <label for="inputTag" class="form-label">Tag</label>
            @error('inputTag')
            <span class="invalid-inputTag" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <div class="search-select-element" data-json-name="tags" data-json-url="/admin/tags/get-json">
                <input type="text" class="form-control search-select-input" value="{{ $question->tag_id ? $question->tag->name : '' }}">
                <input type="text" class="search-select-input-hidden" name="inputTag" value="{{ $question->tag_id ?? '' }}">
            </div>
        </div>
        <div class="col-7">
            <label for="inputQuestion" class="form-label">Question</label>
            @error('inputQuestion')
            <span class="invalid-inputQuestion" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <textarea type="text" class="form-control" name="inputQuestion" id="inputQuestion" required>{{ $question->question }}</textarea>
        </div>
        <div class="col-7">
            <div id="questionAnswersBlock">
                @foreach($question->answers as $index => $answer)
                    <div class="answerBlockItem">
                        <label data-id="{{ $answer->id }}">Answer {{ $index + 1 }}</label> <div data-id="{{ $answer->id }}" class="remove-answer-button">Delete</div>
                        <br><label>Is correct: </label><input class="answer-correct-input" type="checkbox" name="isCorrect[{{ $answer->id }}]" @if($answer->correct) checked @endIf>
                        @if($answer->image)
                            <img data-id="{{ $answer->id }}" src="{{ asset('storage/' . App\Models\Answer::IMAGES_PATH . '/' . $answer->image) }}">
                        @endif
                        <input data-id="{{ $answer->id }}" type="hidden" name="fileAnswerHidden[{{ $answer->id }}][value]" value="{{ $answer->id }}">
                        <input data-id="{{ $answer->id }}" id="answerFile" name="fileAnswer[{{ $answer->id }}][value]" type="file" value="">
                        <textarea data-id="{{ $answer->id }}" type="text" id="answerText" name="textAnswer[{{ $answer->id }}][value]">{{ $answer->text }}</textarea>
                    </div>
                @endforeach
            </div>
            <div id="addAnswerButton" class="btn btn-primary">Add answer</div>
            <div id="answersBlock">
            </div>
        </div>
        <div class="col-7">
            <label for="inputAddedByAdmin" class="form-label">Added by admin</label>
            @error('inputAddedByAdmin')
            <span class="invalid-inputQuestion" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="checkbox" class="form-check-input" name="inputAddedByAdmin" id="inputAddedByAdmin" value="1" {{ $question->isAddedByAdmin() ? 'checked' : '' }}>
        </div>
        <div class="col-7">
            <label for="inputRelease" class="form-label">In release</label>
            @error('inputRelease')
            <span class="invalid-inputQuestion" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="checkbox" class="form-check-input" name="inputRelease" id="inputRelease" value="1" {{ $question->isReleased() ? 'checked' : '' }}>
        </div>
    </form>

    <a href="/admin/questions/list" type="button" class="btn btn-primary">Back</a>
    @if($action === \App\Http\Controllers\Admin\QuestionsBankController::ACTION_EDIT)
        <button type="submit" value="Update" form="edit-question-form" class="btn btn-success">Update</button>
        <a href="/admin/questions/delete/{{ $question->id }}" class="btn btn-danger">Delete</a>
    @else
        <button type="submit" value="Create" form="edit-question-form" class="btn btn-success">Create</button>
    @endif

@endsection
