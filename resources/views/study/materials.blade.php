@extends('layouts.app')

@section('content')
    @include('layouts.part.user_menu')
    <div class="main-content main-content-study">
        <div class="study-materials-block study-materials-block-material">
            <div class="study-materials-block-head">
                <div class="study-materials-block-title">MATERIALS</div>
            </div>
            <div class="study-materials-items">
                @foreach($materials as $material)
                    @include('study.part.material_part', ['material' => $material])
                @endforeach
            </div>
        </div>
    </div>
@endsection
