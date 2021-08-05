<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('fontello/css/fontello.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <div class="fixed-top header-first">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="logo">
                            logotype
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="action">
                            <a href="" class="login-link-btn">Zaloguj się</a>
                            <a href="" class="register-link-btn">Zarejestruj się</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @yield('content')
    </div>
</body>
</html>
