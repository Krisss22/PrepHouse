<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>PrepHouse</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href="{{ asset('css/admin/admin.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/questions.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/quizzes.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/study.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/roles.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin/searchSelectElement.css') }}" rel="stylesheet">
</head>
<body>
    <div id="admin-main-menu" class="d-flex flex-column p-3 text-white bg-dark" style="width: 280px;">
        <a href="/admin/common" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
            <span class="fs-4">PrepHouse</span>
        </a>
        <hr>
        <div class="nav nav-pills flex-column mb-auto">
            <div class="nav-item"><a href="/admin/statistics/list" class="nav-link @if($sectionName === 'statistics') active @endif">Statistics</a></div>
{{--            <li><a href="/admin/common" class="nav-link @if($sectionName === 'common') active @endif">Common</a></li>--}}
            @if(Auth::user()->userRole->checkAccess('topics', \App\Models\Role::showAccessType))
                <div class="nav-item"><a href="/admin/topics/list" class="nav-link @if($sectionName === 'topics') active @endif">Topics</a></div>
            @endif
            @if(Auth::user()->userRole->checkAccess('tags', \App\Models\Role::showAccessType))
                <div class="nav-item"><a href="/admin/tags/list" class="nav-link @if($sectionName === 'tags') active @endif">Tags</a></div>
            @endif
            @if(Auth::user()->userRole->checkAccess('questions', \App\Models\Role::showAccessType))
                <div class="nav-item"><a href="/admin/questions/list" class="nav-link @if($sectionName === 'questions') active @endif">Questions bank</a></div>
            @endif
            @if(Auth::user()->userRole->checkAccess('sent_questions', \App\Models\Role::showAccessType))
                <div class="nav-item"><a href="/admin/sent-questions/list" class="nav-link @if($sectionName === 'sent-questions') active @endif">Sent questions</a></div>
            @endif
            @if(Auth::user()->userRole->checkAccess('quizzes', \App\Models\Role::showAccessType))
                <div class="nav-item"><a href="/admin/quizzes/list" class="nav-link @if($sectionName === 'quizzes') active @endif">Quizzes</a></div>
            @endif
            @if(
                Auth::user()->userRole->checkAccess('study_videos', \App\Models\Role::showAccessType)
                || Auth::user()->userRole->checkAccess('study_materials', \App\Models\Role::showAccessType)
                || Auth::user()->userRole->checkAccess('study_books', \App\Models\Role::showAccessType)
                || Auth::user()->userRole->checkAccess('study_sites', \App\Models\Role::showAccessType)
            )
                <div class="nav-item"><a href="/admin/study/list" class="nav-link @if($sectionName === 'study') active @endif">Study</a></div>
            @endif
            @if(Auth::user()->userRole->checkAccess('vacancies', \App\Models\Role::showAccessType))
                <div class="nav-item"><a href="/admin/vacancies/list" class="nav-link @if($sectionName === 'vacancies') active @endif">Vacancies</a></div>
            @endif
            <div class="nav-item has-sub-menu">
                <div class="nav-item-submenu-label nav-link">Users</div>
                <div class="nav-item-submenu nav-link @if(in_array($sectionName, ['users', 'roles']) ? '' : 'hidden') @endif">
                    @if(Auth::user()->userRole->checkAccess('users', \App\Models\Role::showAccessType))
                        <a href="/admin/users/list" class="nav-link @if($sectionName === 'users') active @endif">Manage users</a>
                    @endif
                    @if(Auth::user()->userRole->checkAccess('roles', \App\Models\Role::showAccessType))
                        <a href="/admin/roles/list" class="nav-link @if($sectionName === 'roles') active @endif">User roles</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div id="admin-content" class="container-fluid">
        @yield('content')
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    <script src="{{ asset('js/functions.js') }}" defer></script>
    <script src="{{ asset('js/admin/menu.js') }}" defer></script>
    <script src="{{ asset('js/admin/searchSelectElement.js') }}" defer></script>
    <script src="{{ asset('js/admin/questions.js') }}" defer></script>
    <script src="{{ asset('js/admin/quizzes.js') }}" defer></script>
    <script src="{{ asset('js/admin/roles.js') }}" defer></script>
</body>
</html>
