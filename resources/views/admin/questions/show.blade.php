@extends('admin.layouts.admin')

@section('content')
    <h1>Question {{ $question->id }}</h1>

    <ul class="list-group content-show-group">
        <li class="list-group-item">ID: {{ $question->id }}</li>
        <li class="list-group-item">Question: {{ $question->question }}</li>
        <li class="list-group-item">Answer (Deprecated. Will bve remove): {{ $question->answer }}</li>
        @foreach($question->answers as $index => $answer)
            <li class="list-group-item @if($answer->correct) correctAnswer @else incorrectAnswer @endIf">
                @if($answer->text)
                    Answer {{ $index + 1 }}: {{ $answer->text }}
                @endif
                @if($answer->image)
                    Answer {{ $index + 1 }}: <img src="{{ '/' . App\Models\Answer::IMAGES_PATH . '/' . $answer->image }}">
                @endif
            </li>
        @endforeach
        <li class="list-group-item">Added by admin: {{ $question->isAddedByAdmin() ? 'Yes' : 'No' }}</li>
        <li class="list-group-item">Released: {{ $question->isReleased() ? 'Yes' : 'No' }}</li>
        <li class="list-group-item">Created at: {{ $question->created_at }}</li>
        <li class="list-group-item">Updated at: {{ $question->updated_at }}</li>
    </ul>

    <a href="/admin/questions/list" type="button" class="btn btn-primary">Back</a>
@endsection
