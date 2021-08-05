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
    <div id="course">
        <nav data-v-071daa38="" class="navbar fixed-top shadow-sm navbar-light bg-white navbar-expand-lg"
             id="desktopNav">
            <div class="container">
                <div data-v-071daa38="" class="row w-100">
                    <div class="col-md-2"><a href="/" class="navbar-brand logo router-link-active" target="_self">logotype</a></div>
                    <div class="col-md-10">
                        <div id="nav-collapse" class="position-relative navbar-collapse collapse"
                             style="display: none;">
                            <ul class="navbar-nav">
                                <li class="nav-item mr-3"><a href="/kurs/" aria-current="page" class="nav-link router-link-exact-active router-link-active" target="_self">Lekcje</a></li>
                                <li class="nav-item mr-3"><a href="/kurs/powtorki" class="nav-link" target="_self">Powtórki</a></li>
                                <li class="nav-item mr-3"><a href="/kurs/strefa-audio" class="nav-link" target="_self">Strefa audio</a></li>
                                <li class="nav-item mr-3"><a href="/kurs/fishki" class="nav-link" target="_self">Fiszki</a></li>
                                <a href="/kurs/wykup-dostep-do-kursu" class="promo-btn"><small>Taniej o 30% jeszcze tylko przez</small> <br><b>23:59:36</b></a>
                                <div class="nav-icons">
                                    <button type="button" class="btn btn-icon btn-secondary"><img
                                            src="/img/add-user.5ce8ed80.svg" alt="Add user"></button>
                                    <button type="button" class="btn btn-icon btn-secondary"><img
                                            src="/img/bell.1257ae85.svg" alt="Bell"></button>
                                </div>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        @yield('content')
    </div>
</div>
</body>
</html>
