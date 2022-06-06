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
                @foreach($topicsAndMaterials as $topic)
                    <div class="study-topic-item">
                        <div class="study-topic-item-progress-block">
                            @for($i = 0; $i < 30; $i++)
                                <div class="study-topic-item-progress-item watched"></div>
                            @endfor
                        </div>
                        <div class="study-topic-item-under-title">TOPIC</div>
                        <div class="study-topic-item-title">{{ $topic['topic']->name }}</div>
                        <div class="study-topic-item-materials-count">{{ $topic['materialsCount'] }}</div>
                        <div class="study-topic-item-materials-text">materials</div>
                        <a href="/study/topic-materials/{{$topic['topic']->id}}" class="study-topic-item-button">Learn Now</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
