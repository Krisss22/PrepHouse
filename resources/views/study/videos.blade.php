@extends('layouts.app')

@section('content')
    @include('layouts.part.user_menu')
    <div class="main-content main-content-study">
        <div class="study-materials-block study-materials-block-video">
            <div class="study-materials-block-head">
                <div class="study-materials-block-title">VIDEOS</div>
            </div>
            <div class="study-materials-items">
                @foreach($videos as $video)
                    @include('study.part.video_part', ['video' => $video])
                @endforeach
            </div>
        </div>
    </div>
@endsection
