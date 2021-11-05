@extends('layouts.app')

@section('content')
    @include('layouts.part.user_menu')
    <div class="main-content">
        <div class="quiz-process-left-block" data-quiz-action-id="{{ $quizAction->id }}">
            <div class="quiz-process-back-button"> BACK TO OCCUPATION</div>
            <div class="quiz-process-job-title">JOB TITLE</div>
            <div class="quiz-process-quiz-title">{{ $quizActionData->name }}</div>
            <div class="quiz-process-questions">
                @foreach($quizActionData->questions as $questionId => $question)
                    <div class="quiz-process-questions-button" data-question-id="{{ $questionId }}">{{ $question->getHumanId() }}</div>
                @endforeach
            </div>
        </div>
        <div class="quiz-process-right-block" data-quiz-question-id="0">
            <div class="quiz-process-progress-block">
                <div class="quiz-process-progress">
                    <div id="quiz-process-progress-data" class="quiz-process-progress-data">0%</div>
                    <div class="quiz-process-progress-bar">
                        <div class="quiz-process-progress-title">PROGRESS</div>
                        <div class="quiz-process-progress-progress">
                            <div id="quiz-process-progress-progress-finish" class="quiz-process-progress-progress-finish"></div>
                        </div>
                    </div>
                </div>

                <div class="quiz-process-finish-button">Finish</div>
            </div>
            <div class="quiz-process-question-block">
                <div class="quiz-process-question-block-title">QUESTION 9</div>
                <div class="quiz-process-question-block-task">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                    Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                </div>
                <div class="quiz-process-question-block-answers-block">
                    @foreach($quizActionData->questions[1]->answers as $answerId => $answer)
                        <div class="quiz-process-question-block-answers-block-item" data-answer-id="{{ $answerId }}">
                            <div class="quiz-process-question-block-answers-block-item-numbering">{{ $answer->getHumanId() }}</div>
                            <div class="quiz-process-question-block-answers-block-item-option">{{ $answer->getOption() }}</div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="quiz-process-navigations-block">
                <div class="quiz-process-navigations-block-button-prev">Back</div>
                <div class="quiz-process-navigations-block-button-next">Next</div>
            </div>
        </div>
    </div>
@endsection
