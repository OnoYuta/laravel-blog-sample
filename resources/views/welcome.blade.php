<!DOCTYPE html>
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
    <link href="{{ asset('css/welcome.css') }}" rel="stylesheet">
</head>

<body>
    <div id='app'>
        <!-- nav-bar -->
        <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
            <div class="container">
                <a href="{{ url('/') }}" class="navbar-brand"><i class="fas fa-braille"></i> {{ config('app.name', 'Laravel') }}</a>
                <button class="navbar-toggler" data-toggle="collapse" data-target="#mainNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNav">
                    <ul class="navbar-nav ml-auto">
                        @if (Route::has('login'))
                        @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url()->to('home') }}">{{ __('Home') }}</a>
                        </li>
                        @else
                        <li class="nav-item ml-auto">
                            <a class="nav-link" href="{{ url()->to('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item ml-auto">
                            <a class="nav-link" href="{{ url()->to('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @endauth
                        @endif
                        <li class="nav-item">
                    </ul>
                </div>
            </div>
        </nav>

        <!-- header -->
        <header class="text-center">
            <div class="container vh-100 d-flex justify-content-center align-items-center flex-column">
                <p class="site-title-sub display-5">Sample blog project featuring many basic and general topics.</p>
                <h1 class="d-md-4 display-2 site-title">{{ config('app.name', 'Laravel') }}</h1>
                <p class="site-description display-5">Check out come of my works.</p>
                <div class="row w-100 d-flex justify-content-center">
                    <a href="{{ url('/') }}" class="btn btn-primary col-4 col-sm-3 col-md-2">Primary</a>
                    <a href="{{ url('/') }}" class="btn btn-secondary offset-1 col-4 col-sm-3 col-md-2">Secondary</a>
                </div>
            </div>
        </header>
    </div>
</body>

</html>