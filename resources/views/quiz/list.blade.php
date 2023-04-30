@extends('layouts.app')

@section('content')
    @include('layouts.part.user_menu')
    <div class="main-content">
        <div class="quiz-section-title">Choose your area of expertise</div>
        @if(Auth::check())
            <a href="{{ route('quiz-statistic-list') }}" class="quiz-section-history-button">History</a>
        @endif
        <div class="expertise-areas-list">
            @foreach($expertiseAreasList as $index => $expertiseArea)
                <div data-expertise-name="{{ $expertiseArea->name }}" class="expertise-areas-item {{ $index === 0 ? 'active' : '' }}">{{ $expertiseArea->name }}</div>
            @endforeach
        </div>
        <div id="area-quiz-select" class="quiz-item-list">
            @foreach($quizzesList as $quiz)
            <div data-expertise-name="{{ $quiz->expertiseArea->name ?? '' }}" class="quiz-item-list-item {{ $quiz->processStatusClass }} {{ $expertiseAreasList[0]->name !== ($quiz->expertiseArea->name ?? '') ? 'hidden' : '' }}">
                <div class="quiz-item-top-block">
                    @if(isset($quiz->quiz_action_data))
                        <div class="quiz-item-progress-bar">
                            <div class="quiz-item-progress-bar-line" style="width: {{ $quiz->quiz_action_data->getProgressPercent() }}%;"></div>
                        </div>
                    @endif
                    <div class="quiz-item-progress-job-title-text">Job title</div>
                    <div class="quiz-item-progress-job-title"><span>{{ $quiz->name }}</span> <div class="quiz-item-progress-job-title-icon"></div></div>
                </div>
                <div class="quiz-item-bottom-block">
                    <div class="quiz-item-questions-count">
                        @if(isset($quiz->quiz_action_data))
                            {{ $quiz->quiz_action_data->getAnsweredQuestionsCount() }}
                        @else
                            0
                        @endif
                        / {{ $quiz->getAllQuestionsCount(true) }}</div>
                    <div class="quiz-item-questions-count-title">questions</div>
                    <a href="/quiz/run/{{ $quiz->id }}" target="_blank">
                        @if(isset($quiz->quiz_action_data) && !$quiz->quiz_action_finished)
                            <div class="quiz-item-button continue-button">
                                Continue
                            </div>
                        @else
                            <div class="quiz-item-button">
                                Start
                            </div>
                        @endif
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div id="area-quiz-share" class="quiz-share-suggestion">
            <div class="quiz-share-suggestion-button">+</div>
            <div class="quiz-share-suggestion-text">
                <div class="quiz-share-suggestion-title">Didn't find your occupation?</div>
                <div class="quiz-share-suggestion-description">Please share your suggestions and we will consider adding it later. </div>
            </div>
        </div>
        <div class="quiz-share-footer">Copyright © {{ date('Y') }} PrepHouse</div>
    </div>
@endsection
