<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/home/home.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/nicepage.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/PrepHouse.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/css/bootstrap.min.css" integrity="2hfp1SzUoho7/TsGGGDaFdsuuDL0LX2hnUp6VkX3CUQ2K4K+xjboZdsXyp4oUHZj" crossorigin="anonymous">
</head>
<body data-home-page="PrepHouse.html" data-home-page-title="PrepHouse" class="u-body">
    <header class="u-clearfix u-custom-color-14 u-header u-header" id="sec-02e7">
        <div class="u-clearfix u-sheet u-sheet-1">
            <nav class="u-align-right u-menu u-menu-dropdown u-offcanvas u-menu-1">
                <div class="u-custom-menu u-nav-container">
                    <ul class="u-nav u-unstyled u-nav-1">
                        <li class="u-nav-item" data-toggle="modal" data-target="#questionModal">Share question</li>
                        @guest
                            @if (Route::has('login'))
                                <li class="u-nav-item">
                                    <a class="u-button-style u-nav-link u-text-active-palette-1-light-3 u-text-hover-palette-2-base u-text-white" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="u-nav-item">
                                    <a class="u-button-style u-nav-link u-text-active-palette-1-light-3 u-text-hover-palette-2-base u-text-white" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="u-nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
                <div class="u-custom-menu u-nav-container-collapse">
                    <div class="u-black u-container-style u-inner-container-layout u-opacity u-opacity-95 u-sidenav">
                        <div class="u-sidenav-overflow">
                            <div class="u-menu-close"></div>
                            <ul class="u-align-center u-nav u-popupmenu-items u-unstyled u-nav-2"><li class="u-nav-item"><a class="u-button-style u-nav-link" href="PrepHouse.html" style="padding: 10px 20px;">PrepHouse</a>
                                </li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="Study-Materials.html" target="_blank" style="padding: 10px 20px;">Study Materials</a>
                                </li><li class="u-nav-item"><a class="u-button-style u-nav-link" href="QUIZ.html" target="_blank" style="padding: 10px 20px;">QUIZ</a>
                                </li></ul>
                        </div>
                    </div>
                    <div class="u-black u-menu-overlay u-opacity u-opacity-70"></div>
                </div>
            </nav>
            <a href="PrepHouse.html" data-page-id="11240865" class="u-image u-logo u-image-1" data-image-width="1348" data-image-height="420" title="PrepHouse">
                <img src="images/ScreenShot2021-04-04at11.07.44AM.png" class="u-logo-image u-logo-image-1" data-image-width="254.2859">
            </a>
        </div>
    </header>

    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Модальное окно -->
    <div class="modal fade" id="questionModal" tabindex="-1" role="dialog" aria-labelledby="questionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="questionModalLabel">Send question for help</h4>
                </div>
                <div class="modal-body">
                    <form method="POST" id="sendQuestionForm">
                        @csrf
                        <div class="form-group row">
                            <label for="inputVacancy" class="col-md-12 col-form-label">Vacancy</label>
                            <div class="col-md-12">
                                <select name="inputVacancy" class="form-select form-control" required>
                                    @foreach($vacancies ?? [] as $vacancy)
                                        <option value="{{ $vacancy->id }}">{{ $vacancy->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="question" class="col-md-12 col-form-label">Question</label>
                            <div class="col-md-12">
                                <textarea id="question" class="form-control" name="question" required></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="answer" class="col-md-12 col-form-label">Answer (optional)</label>
                            <div class="col-md-12">
                                <textarea id="answer" class="form-control" name="answer"></textarea>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer align-content-center">
                    <button id="sendQuestionButton" type="button" class="btn btn-primary">Send question</button>
                    <div class="question-modal-register-offer-text">Register now to skip adding questions and keep track of your interview/quizes results</div>
                    <a href="/register" class="btn btn-success">Register Now</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js" integrity="sha384-VjEeINv9OSwtWFLAtmc4JCtEJXXBub00gtSnszmspDLCtC0I4z4nqz7rEFbIZLLU" crossorigin="anonymous"></script>
    <script src="js/home/home.js"></script>
</body>
</html>
