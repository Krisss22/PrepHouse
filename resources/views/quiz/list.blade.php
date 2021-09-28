@extends('layouts.app')

@section('content')
    @include('layouts.part.user_menu')
    <div class="main-content">
        <div class="quiz-section-title">Choose a desired occupation</div>
        <div class="quiz-item-list">
            @foreach([0,1,2,3,4,5,6,7] as $c)
            <div class="quiz-item-list-item">
                <div class="quiz-item-top-block">
                    <div class="quiz-item-progress-bar"><div class="quiz-item-progress-bar-line"></div></div>
                    <div class="quiz-item-progress-job-title-text">Job title</div>
                    <div class="quiz-item-progress-job-title">Test title <div class="quiz-item-progress-job-title-icon"></div></div>
                </div>
                <div class="quiz-item-bottom-block">
                    <div class="quiz-item-questions-count">97/100</div>
                    <div class="quiz-item-questions-count-title">questions</div>
                    <div class="quiz-item-button">Start</div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="quiz-share-suggestion">
            <div class="quiz-share-suggestion-button">+</div>
            <div class="quiz-share-suggestion-text">
                <div class="quiz-share-suggestion-title">Didn't find your occupation?</div>
                <div class="quiz-share-suggestion-description">Please share your suggestions and we will consider adding it later. </div>
            </div>
        </div>
        <div class="quiz-share-footer">Copyright © 2021 PrepHome</div>
    </div>
@endsection
