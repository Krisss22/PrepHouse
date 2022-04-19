@extends('layouts.app')

@section('content')
    @include('layouts.part.user_menu')
    <div class="main-content main-content-study">
        <div class="study-materials-block study-materials-block-book">
            <div class="study-materials-block-head">
                <div class="study-materials-block-title">BOOKS</div>
            </div>
            <div class="study-materials-items">
                @foreach($books as $book)
                    @include('study.part.book_part', ['book' => $book])
                @endforeach
            </div>
        </div>
    </div>
@endsection
