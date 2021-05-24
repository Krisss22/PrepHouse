@extends('admin.layouts.admin')

@section('content')
    <h1>Vacancy {{ $vacancy->id }}</h1>

    <form method="post" action="/admin/vacancies/{{ $action }}{{ $vacancy->id ? '/' . $vacancy->id : '' }}" id="edit-vacancy-form" class="row g-3 content-edit-group">
        @method('post')
        @csrf
        <div class="col-7">
            <label for="inputName" class="form-label">Vacancy name</label>
            @error('inputName')
            <span class="invalid-inputName" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
            <input type="text" class="form-control" name="inputName" id="inputName" value="{{ $vacancy->name }}" required>
        </div>
    </form>

    <a href="/admin/vacancies/list" type="button" class="btn btn-primary">Back</a>
    @if($action === \App\Http\Controllers\Admin\VacancyController::ACTION_EDIT)
        <button type="submit" value="Update" form="edit-vacancy-form" class="btn btn-success">Update</button>
        <a href="/admin/vacancies/delete/{{ $vacancy->id }}}" class="btn btn-danger">Delete</a>
    @else
        <button type="submit" value="Create" form="edit-vacancy-form" class="btn btn-success">Create</button>
    @endif

@endsection
