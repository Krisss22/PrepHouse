<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
{{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link rel="https://cdn.rawgit.com/mfd/7c7a915eb31474cc8c6a65066a4c4dc3/raw/f0f2fb94c21dea904812a53e0eb6cf0bc87f3754/GTWalsheimPro.css">
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth/auth.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/quiz/quiz.css') }}" rel="stylesheet">
    <link href="{{ asset('css/quiz/statistic.css') }}" rel="stylesheet">
    <link href="{{ asset('css/share_question/share_question.css') }}" rel="stylesheet">
    <link href="{{ asset('css/account/account.css') }}" rel="stylesheet">
</head>
<body data-home-page="PrepHouse.html" data-home-page-title="PrepHouse" class="u-body">
    <div id="app">
        @yield('content')
    </div>

    <div id="notificationPopup"></div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js" integrity="sha384-VjEeINv9OSwtWFLAtmc4JCtEJXXBub00gtSnszmspDLCtC0I4z4nqz7rEFbIZLLU" crossorigin="anonymous"></script>
    <script src="{{ asset('js/functions.js') }}"></script>
    <script src="{{ asset('js/home/home.js') }}"></script>
    <script src="{{ asset('js/quiz/quiz.js') }}"></script>
    <script src="{{ asset('js/account/account.js') }}"></script>
{{--    <script src="{{ asset('js/share_question.js') }}"></script>--}}
</body>
</html>
