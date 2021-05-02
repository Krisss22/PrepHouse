@extends('admin.layouts.admin')

@section('content')
    <h1>Question {{ $question->id }}</h1>

    <form method="post" action="/admin/questions/{{ $action }}/{{ $question->id }}" id="edit-question-form" class="row g-3 question-edit-group">
        @method('post')
        @csrf
        <div class="col-7">
            <label for="inputVacancy" class="form-label">Job vacancy</label>
            @error('inputVacancy')
            <span class="invalid-inputVacancy" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <select name="inputVacancy" class="form-select" required>
                @foreach($vacancies as $vacancy)
                    <option value="{{ $vacancy->id }}">{{ $vacancy->name }}</option>
                @endforeach
            </select>
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
    </form>

    <a href="/admin/questions/list" type="button" class="btn btn-primary">Back</a>
    @if($action === \App\Http\Controllers\Admin\QuestionsBankController::ACTION_EDIT)
        <button type="submit" value="Update" form="edit-question-form" class="btn btn-success">Update</button>
        <a href="/admin/questions/delete/{{ $question->id }}}" class="btn btn-danger">Delete</a>
    @else
        <button type="submit" value="Create" form="edit-question-form" class="btn btn-success">Create</button>
    @endif

@endsection
