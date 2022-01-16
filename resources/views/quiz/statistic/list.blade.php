@extends('layouts.app')

@section('content')
    @include('layouts.part.user_menu')
    <div class="main-content">
        <div class="quiz-statistic-section-title">Quizzes statistic</div>
        <div class="quiz-statistic-item-list">
            @if(count($statisticItemsList) > 0)
                @foreach($statisticItemsList as $key => $statisticItem)
                    <div class="quiz-statistic-list-item">
                        <div class="quiz-statistic-list-item-number">{{ ($key + 1) }}</div>
                        <div class="quiz-statistic-list-item-name">{{ $statisticItem->quiz->name }}</div>
                        <a href="{{ route('quiz-statistic', ['quizActionId' => $statisticItem->id]) }}" class="quiz-statistic-list-item-show-statistic-button">Show statistic</a>
                    </div>
                @endforeach
                {{ $statisticItemsList->links('layouts.pagination.quiz_statistic_pagination') }}
            @endif
        </div>
    </div>
@endsection
