@extends('layouts.app')

@section('content')
    @include('layouts.part.user_menu')
    <div class="main-content quiz-process-main-content">
        <div class="quiz-process-left-block" data-quiz-action-id="{{ $quizAction->id }}">
            <div class="quiz-process-back-button"><a href="{{ route('quizzes-list') }}"><span>&#8592;</span> BACK TO OCCUPATION</a></div>
            <div class="quiz-process-job-title">JOB TITLE</div>
            <div class="quiz-process-quiz-title">{{ $quizActionData->name }}</div>
            <div class="quiz-process-questions">
                @foreach($quizActionData->questions as $questionId => $question)
                    <div class="quiz-process-questions-button {{ !empty($question->usersAnswer) ? 'answered' : '' }}" data-question-id="{{ $questionId }}">{{ $question->getHumanId() }}</div>
                @endforeach
            </div>
        </div>
        <div class="quiz-process-right-block" data-quiz-question-id="{{ $currentQuestion->id }}">
            <div class="quiz-process-progress-block">
                <div class="quiz-process-progress">
                    <div id="quiz-process-progress-data" class="quiz-process-progress-data">{{ $quizActionData->getProgressPercent() }}%</div>
                    <div class="quiz-process-progress-bar">
                        <div class="quiz-process-progress-title">PROGRESS</div>
                        <div class="quiz-process-progress-progress">
                            <div id="quiz-process-progress-progress-finish" class="quiz-process-progress-progress-finish"></div>
                        </div>
                    </div>
                </div>

                <a href="/quiz/finish/{{ $quizAction->id }}" class="quiz-process-finish-button">Finish</a>
            </div>
            <div id="quiz-process-question-block" class="quiz-process-question-block">
                <div class="quiz-process-question-block-title">QUESTION <span>{{ $currentQuestion->getHumanId() }}</span></div>
                <div class="quiz-process-question-block-image">
                    @if($currentQuestion->questionImage)
                        <img alt="" src="{{ asset('storage/' . \App\Models\QuestionsBank::IMAGES_PATH . '/' . $currentQuestion->questionImage) }}">
                    @endif
                </div>
                <div class="quiz-process-question-block-task">{{ $currentQuestion->question }}</div>
                <div id="quiz-process-question-block-answers-block" class="quiz-process-question-block-answers-block">
                    @foreach($currentQuestion->answers as $answerId => $answer)
                        <div class="quiz-process-question-block-answers-block-item {{ $currentQuestion->isAnswerSelected($answerId) ? 'active' : '' }}" data-answer-id="{{ $answerId }}">
                            <div class="quiz-process-question-block-answers-block-item-numbering">{{ $answer->getHumanId() }}</div>
                            @if($answer->image)
                                <div class="quiz-process-question-block-answers-block-item-option"><img alt="" src="{{ $answer->getOption('image') }}"></div>
                            @endif
                            @if($answer->text)
                                <div class="quiz-process-question-block-answers-block-item-option">{{ $answer->getOption('text') }}</div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="quiz-process-navigations-block">
                <div class="quiz-process-navigations-block-button-prev {{ $previousQuestionId === null ? 'disabled' : '' }}" data-question-id="{{ $previousQuestionId ?? '' }}">Back</div>
                <div class="quiz-process-navigations-block-button-next {{ $nextQuestionId === null ? 'disabled' : '' }}" data-question-id="{{ $nextQuestionId ?? '' }}">Next</div>
            </div>
        </div>
    </div>
@endsection
