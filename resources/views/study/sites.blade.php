@extends('layouts.app')

@section('content')
    @include('layouts.part.user_menu')
    <div class="main-content main-content-study">
        <div class="study-materials-block study-materials-block-site">
            <div class="study-materials-block-head">
                <div class="study-materials-block-title">SITES</div>
            </div>
            <div class="study-materials-items">
                @foreach($sites as $site)
                    @include('study.part.site_part', ['site' => $site])
                @endforeach
            </div>
        </div>
    </div>
@endsection
