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
            <div class="search-select-element">
                <input type="text" class="form-control search-select-input" value="{{ $question->tag_id ? $question->tag->name : '' }}">
                <input type="text" class="search-select-input-hidden" name="inputTag" value="{{ $question->tag_id ?? '' }}">
                <div class="search-select-results">
                    @foreach($tags as $tag)
                        <div data-tag-id="{{ $tag->id }}" class="search-select-results-item search-select-results-item-hidden">{{ $tag->name }}</div>
                    @endforeach
                </div>
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
            <label for="inputUserAnswer" class="form-label">User's Answer (Deprecated. Will be remove)</label>
            @error('inputQuestion')
            <span class="invalid-inputUserAnswer" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <textarea type="text" class="form-control" name="inputUserAnswer" id="inputUserAnswer">{{ $question->answer }}</textarea>
        </div>
        <div class="col-7">
            <div id="questionAnswersBlock">
                @foreach($question->answers as $index => $answer)
                    @if($answer->text)
                        <div class="answerBlockItem">
                            <label data-id="{{ $answer->id }}">Answer {{ $index + 1 }}</label> <div data-id="{{ $answer->id }}" class="remove-answer-button">Delete</div>
                            <br><label>Is correct: </label><input class="answer-correct-input" type="checkbox" name="textAnswer[{{ $answer->id }}][correct]" @if($answer->correct) checked @endIf>
                            <textarea data-id="{{ $answer->id }}" type="text" id="answerText" name="textAnswer[{{ $answer->id }}][value]">{{ $answer->text }}</textarea>
                        </div>
                    @endif
                    @if($answer->image)
                        <div class="answerBlockItem">
                            <label data-id="{{ $answer->id }}">Answer {{ $index + 1 }}</label> <div data-id="{{ $answer->id }}" class="remove-answer-button">Delete</div>
                            <br><label>Is correct: </label><input class="answer-correct-input" type="checkbox" name="fileAnswerHidden[{{ $answer->id }}][correct]" @if($answer->correct) checked @endIf>
                            <img data-id="{{ $answer->id }}" src="{{ '/' . App\Models\Answer::IMAGES_PATH . '/' . $answer->image }}">
                            <input data-id="{{ $answer->id }}" type="hidden" name="fileAnswerHidden[{{ $answer->id }}][value]" value="{{ $answer->id }}">
                            <input data-id="{{ $answer->id }}" id="answerFile" name="fileAnswer[{{ $answer->id }}]" type="file" value="">
                        </div>
                    @endif
                @endforeach
            </div>
            <div id="addAnswerButton" class="btn btn-primary">Add answer</div>
            <div id="addAnswerButtonsBlock" class="hidden">
                <div class="btn btn-secondary add-answer-type-button" data-answer-type="text">Text</div>
                <div class="btn btn-secondary add-answer-type-button" data-answer-type="file">File</div>
            </div>
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
