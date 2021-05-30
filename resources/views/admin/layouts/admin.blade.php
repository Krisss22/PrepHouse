<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="{{ asset('css/admin/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/searchSelectElement.css') }}" rel="stylesheet">
</head>
<body>
    <div id="admin-main-menu" class="d-flex flex-column p-3 text-white bg-dark" style="width: 280px;">
        <a href="/admin/common" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-4">PrepHouse</span>
        </a>
        <hr>
        <ul class="nav nav-pills flex-column mb-auto">
            <li class="nav-item"><a href="/admin/statistics/list" class="nav-link @if($sectionName === 'statistics') active @endif">Statistics</a></li>
{{--            <li><a href="/admin/common" class="nav-link @if($sectionName === 'common') active @endif">Common</a></li>--}}
            <li><a href="/admin/topics/list" class="nav-link @if($sectionName === 'topics') active @endif">Topics</a></li>
            <li><a href="/admin/tags/list" class="nav-link @if($sectionName === 'tags') active @endif">Tags</a></li>
            <li><a href="/admin/questions/list" class="nav-link @if($sectionName === 'questions') active @endif">Questions bank</a></li>
            <li><a href="/admin/vacancies/list" class="nav-link @if($sectionName === 'vacancies') active @endif">Vacancies</a></li>
            <li><a href="/admin/users/list" class="nav-link @if($sectionName === 'users') active @endif">Users</a></li>
        </ul>
    </div>
    <div id="admin-content" class="container-fluid">
        @yield('content')
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script src="{{ asset('js/functions.js') }}" defer></script>
    <script src="{{ asset('js/admin/searchSelectElement.js') }}" defer></script>
</body>
</html>
