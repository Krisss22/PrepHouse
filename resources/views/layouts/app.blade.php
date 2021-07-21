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
{{--    <link rel="dns-prefetch" href="//fonts.gstatic.com">--}}
{{--    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">--}}

    <!-- Styles -->
    <link rel="https://cdn.rawgit.com/mfd/7c7a915eb31474cc8c6a65066a4c4dc3/raw/f0f2fb94c21dea904812a53e0eb6cf0bc87f3754/GTWalsheimPro.css">
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    <link href="{{ asset('css/auth/auth.css') }}" rel="stylesheet">
    <link href="{{ asset('css/home/home.css') }}" rel="stylesheet">
</head>
<body data-home-page="PrepHouse.html" data-home-page-title="PrepHouse" class="u-body">
    <div id="app">
        @yield('content')
    </div>

    <div id="notificationPopup"></div>

    <!-- Модальное окно -->
{{--    <div class="modal fade" id="questionModal" tabindex="-1" role="dialog" aria-labelledby="questionModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                    <h4 class="modal-title" id="questionModalLabel">Send question for help</h4>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <form method="POST" id="sendQuestionForm">--}}
{{--                        @csrf--}}
{{--                        <div class="form-group row">--}}
{{--                            <label for="inputVacancy" class="col-md-12 col-form-label">Vacancy</label>--}}
{{--                            <div class="col-md-12">--}}
{{--                                <select name="inputVacancy" class="form-select form-control" required>--}}
{{--                                    @foreach($vacancies ?? [] as $vacancy)--}}
{{--                                        <option value="{{ $vacancy->id }}">{{ $vacancy->name }}</option>--}}
{{--                                    @endforeach--}}
{{--                                </select>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label for="question" class="col-md-12 col-form-label">Question</label>--}}
{{--                            <div class="col-md-12">--}}
{{--                                <textarea id="question" class="form-control" name="question" required></textarea>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-group row">--}}
{{--                            <label for="answer" class="col-md-12 col-form-label">Answer (optional)</label>--}}
{{--                            <div class="col-md-12">--}}
{{--                                <textarea id="answer" class="form-control" name="answer"></textarea>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--                <div class="modal-footer align-content-center">--}}
{{--                    <button id="sendQuestionButton" type="button" class="btn btn-primary">Send question</button>--}}
{{--                    <div class="question-modal-register-offer-text">Register now to skip adding questions and keep track of your interview/quizes results</div>--}}
{{--                    <a href="/register" class="btn btn-success">Register Now</a>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js" integrity="sha384-THPy051/pYDQGanwU6poAc/hOdQxjnOEXzbT+OuUAFqNqFjL+4IGLBgCJC3ZOShY" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.2.0/js/tether.min.js" integrity="sha384-Plbmg8JY28KFelvJVai01l8WyZzrYWG825m+cZ0eDDS1f7d/js6ikvy1+X+guPIB" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.4/js/bootstrap.min.js" integrity="sha384-VjEeINv9OSwtWFLAtmc4JCtEJXXBub00gtSnszmspDLCtC0I4z4nqz7rEFbIZLLU" crossorigin="anonymous"></script>
    <script src="js/home/home.js"></script>
</body>
</html>
