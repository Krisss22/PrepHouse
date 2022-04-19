@extends('layouts.app')

@section('content')
    @include('layouts.part.user_menu')
    <div class="main-content main-content-study">
        <div class="study-section-title">All learning materials related to : {{ $topicName }}</div>

        <div class="study-materials-block study-materials-block-video">
            <div class="study-materials-block-head">
                <div class="study-materials-block-title">VIDEOS</div>
                <a href="{{ route('videos', $topicId) }}" class="study-materials-block-see-all">See All</a>
            </div>
            <div class="study-materials-items">
                @foreach($videos as $video)
                    @include('study.part.video_part', ['video' => $video])
                @endforeach
            </div>
        </div>

        <div class="study-materials-block study-materials-block-book">
            <div class="study-materials-block-head">
                <div class="study-materials-block-title">BOOKS</div>
                <a href="{{ route('books', $topicId) }}" class="study-materials-block-see-all">See All</a>
            </div>
            <div class="study-materials-items">
                @foreach($books as $book)
                    @include('study.part.book_part', ['book' => $book])
                @endforeach
            </div>
        </div>

        <div class="study-materials-block study-materials-block-material">
            <div class="study-materials-block-head">
                <div class="study-materials-block-title">MATERIALS</div>
                <a href="{{ route('materials', $topicId) }}" class="study-materials-block-see-all">See All</a>
            </div>
            <div class="study-materials-items">
                @foreach($materials as $material)
                    @include('study.part.material_part', ['material' => $material])
                @endforeach
            </div>
        </div>

        <div class="study-materials-block study-materials-block-site">
            <div class="study-materials-block-head">
                <div class="study-materials-block-title">SITES</div>
                <a href="{{ route('sites', $topicId) }}" class="study-materials-block-see-all">See All</a>
            </div>
            <div class="study-materials-items">
                @foreach($sites as $site)
                    @include('study.part.site_part', ['site' => $site])
                @endforeach
            </div>
        </div>
    </div>
@endsection
