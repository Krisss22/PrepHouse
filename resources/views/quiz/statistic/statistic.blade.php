@extends('layouts.app')

@section('content')
    @include('layouts.part.user_menu')
    <div class="main-content">
        <a href="{{ route('quizzes-list') }}" class="quiz-statistic-back-button"><span>&#8592;</span> BACK TO OCCUPATIONS</a>
        <div class="quiz-statistic-date">{{ $quizAction->getStartDate() }}</div>
        <div class="quiz-statistic-title">{{ $quizActionData->name }}</div>
        <div class="quiz-statistic-block">
            <div class="quiz-statistic-score-title">Your Score</div>
            <div class="quiz-statistic-diagram">
                <svg width="300px" height="300px" viewBox="0 0 42 42" class="donut">
                    <circle class="donut-hole" cx="21" cy="21" r="15.91549430918954" fill="#fff"></circle>
                    <circle class="donut-ring" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#25b6a1" stroke-width="1" stroke-dashoffset="25" stroke-dasharray="{{ $quizActionData->getCorrectAnsweredPercent() }} {{ $quizActionData->getIncorrectAnsweredPercent() }}"></circle>
                    <circle class="donut-segment" cx="21" cy="21" r="15.91549430918954" fill="transparent" stroke="#ee3a40" stroke-width="1" stroke-dashoffset="{{ 100 - $quizActionData->getCorrectAnsweredPercent() + 25 }}" stroke-dasharray="{{ $quizActionData->getIncorrectAnsweredPercent() }} {{ $quizActionData->getCorrectAnsweredPercent() }}"></circle>
                </svg>
                <div class="quiz-statistic-diagram-value">{{ $quizActionData->getCorrectAnsweredPercent() }}<span>%</span></div>
            </div>
            <div class="quiz-statistic-answers-count-block">
                <div class="quiz-statistic-correct-answers"><span class="quiz-statistic-orb"></span> Correct answers <span class="quiz-statistic-count">{{ $quizActionData->getSuccessfulAnswersCount() }}</span></div>
                <div class="quiz-statistic-incorrect-answers"><span class="quiz-statistic-orb"></span> Incorrect answers <span class="quiz-statistic-count">{{ $quizActionData->getUnsuccessfulAnswersCount() }}</span></div>
            </div>
            <a href="{{ route('quiz-run', ['quizId' => $quizAction->quiz_id]) }}" class="quiz-statistic-reset-button">Reset & Re-Take Exam <span></span></a>
            <div class="quiz-statistic-separate-line"></div>
            <div class="quiz-statistic-content-block">
                <div class="quiz-statistic-content-title">Readiness by content area</div>
                <div class="quiz-statistic-status-block">
                    <div class="quiz-statistic-status-label quiz-statistic-status-label-not-ready"><span></span> Not ready</div>
                    <div class="quiz-statistic-status-label quiz-statistic-status-label-almost-ready"><span></span> Almost ready</div>
                    <div class="quiz-statistic-status-label quiz-statistic-status-label-ready"><span></span> You are ready</div>
                </div>
                <div class="quiz-statistic-content-graph-title">Preparation by topic</div>
                <div class="quiz-statistic-content-graph-description">Proficiency goal {{ $quizActionData::getMinimumSuccessfulPercent() }}%</div>
                <div class="quiz-statistic-content-graph-block">
                    @foreach($quizActionData->tags as $tagId => $tag)
                        <div class="quiz-statistic-content-graph-item">
                            @if($quizActionData->getCorrectAnsweredPercent($tagId) >= $quizActionData::getMinimumSuccessfulPercent())
                                <span class="quiz-statistic-content-graph-item-status-button quiz-statistic-content-graph-item-status-button-check"></span>
                            @elseif(
                                $quizActionData->getCorrectAnsweredPercent($tagId) < $quizActionData::getMinimumSuccessfulPercent()
                                && $quizActionData->getCorrectAnsweredPercent($tagId) >= $quizActionData::getMinimumAlmostSuccessfulPercent()
                            )
                                <span class="quiz-statistic-content-graph-item-status-button quiz-statistic-content-graph-item-status-button-oval"></span>
                            @else
                                <span class="quiz-statistic-content-graph-item-study-button"></span>
                                <span class="quiz-statistic-content-graph-item-status-button quiz-statistic-content-graph-item-status-button-cross"></span>
                            @endif
                            <div class="quiz-statistic-content-graph-item-line
                                @if($quizActionData->getCorrectAnsweredPercent($tagId) >= $quizActionData::getMinimumSuccessfulPercent())
                                    check
                                @elseif(
                                    $quizActionData->getCorrectAnsweredPercent($tagId) < $quizActionData::getMinimumSuccessfulPercent()
                                    && $quizActionData->getCorrectAnsweredPercent($tagId) >= $quizActionData::getMinimumAlmostSuccessfulPercent()
                                )
                                    oval
                                @else
                                    cross
                                @endif
                            ">
                                <div class="quiz-statistic-content-graph-item-line-progress" style="width: {{ $quizActionData->getCorrectAnsweredPercent($tagId) }}%;"></div>
                                <div class="quiz-statistic-content-graph-item-label">{{ $tag }}</div>
                                <div class="quiz-statistic-content-graph-item-percent">{{ $quizActionData->getCorrectAnsweredPercent($tagId) }}%</div>
                            </div>
                        </div>
                    @endforeach
                    <div class="quiz-statistic-content-graph-item-border quiz-statistic-content-graph-item-almost-border"></div>
                    <div class="quiz-statistic-content-graph-item-border quiz-statistic-content-graph-item-ready-border"></div>
                </div>
            </div>
        </div>
        <div class="quiz-statistic-recommendation-block">
            <div class="quiz-statistic-recommendation-title">Study Recommendations</div>
            <div class="quiz-statistic-recommendation-left-block">
                <div class="quiz-statistic-recommendation-first-description">
                    Based on your score, we prepared amazing study materials that will help you to improve your skills.
                    It is absolutely free!
                </div>
                <div class="quiz-statistic-recommendation-second-description">
                    <span></span> All training materials in a convenient place
                </div>
                <div class="quiz-statistic-recommendation-third-description">
                    <span></span> We provide materials on your topic
                </div>
                <div class="quiz-statistic-recommendation-button">
                    Go to Dashboard <span>&#8594;</span>
                </div>
            </div>
            <div class="quiz-statistic-recommendation-right-block">
                <div class="quiz-statistic-recommendation-image"></div>
            </div>
        </div>
    </div>
@endsection
