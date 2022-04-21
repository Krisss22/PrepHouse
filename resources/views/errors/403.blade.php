<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <title>PrepHouse</title>
    <link href="{{ asset('css/errors/errors.css') }}" rel="stylesheet">
</head>
<body data-home-page="PrepHouse.html" data-home-page-title="PrepHouse" class="u-body">
<div id="app">
    <div class="error-logo-block">
        <img src="{{ asset('images/logo.svg') }}">
        <br>
        <img class="error-logo-title" src="{{ asset('images/site-title.svg') }}">
    </div>

    <div class="error-description">We're sorry, but something went wrong</div>

    <div class="error-code-image">
        <img src="{{ asset('images/errors/4.svg') }}">
        <img src="{{ asset('images/errors/lock.svg') }}">
        <img src="{{ asset('images/errors/3.svg') }}">
    </div>

    <div class="error-check-log-description">If you are the application owner check the logs for more information.</div>

    <a href="/" class="error-go-home-button">Go Home</a>
</div>
</body>
</html>
