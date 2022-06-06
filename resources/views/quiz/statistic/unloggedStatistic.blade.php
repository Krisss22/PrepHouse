@extends('layouts.app')

@section('content')
    <div class="main-content main-content-statistic-example">
        <div class="statistic-example">
            <img src="{{ asset('images/quiz/statistic/statistic-example.svg') }}">
        </div>
        <div class="statistic-authorization">
            <div class="statistic-authorization-block">
                <img class="statistic-authorization-icon" src="{{ asset('images/icon-horizontal.svg') }}">
                <div class="statistic-authorization-title">Create a free account to see quiz results</div>
                <div class="statistic-authorization-description">You will be able to save your progress and review your results for any quiz</div>
                @include('auth.part.register-form')
                <div class="have-account-block">Already have an account? <a href="{{ route('login') }}" class="statistic-authorization-login-link">Log In</a></div>
            </div>
        </div>
    </div>
@endsection
