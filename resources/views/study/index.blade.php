@extends('layouts.app')

@section('content')
    @include('layouts.part.user_menu')
    <div class="main-content main-content-study">
        <div class="study-section-block">
            <div class="study-search-block">
                <img src="{{ asset('images/search.svg') }}">
                <input id="search" placeholder="Search">
            </div>
            <div class="study-section-title">Your Learning House</div>
            <div class="study-topics-list">
                @foreach($topics as $topic)
                    <div class="study-topic-item">
                        <div class="study-topic-item-progress-block">
                            <div class="study-topic-item-progress-item watched"></div>
                            <div class="study-topic-item-progress-item watched"></div>
                            <div class="study-topic-item-progress-item watched"></div>
                            <div class="study-topic-item-progress-item watched"></div>
                            <div class="study-topic-item-progress-item"></div>
                            <div class="study-topic-item-progress-item"></div>
                            <div class="study-topic-item-progress-item"></div>
                            <div class="study-topic-item-progress-item"></div>
                            <div class="study-topic-item-progress-item"></div>
                        </div>
                        <div class="study-topic-item-under-title">TOPIC</div>
                        <div class="study-topic-item-title">{{ $topic->name }}</div>
                        <div class="study-topic-item-materials-count">46</div>
                        <div class="study-topic-item-materials-text">materials</div>
                        <a href="/" class="study-topic-item-button">Learn Now</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
