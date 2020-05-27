<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @section('title', config('app.name', 'Laravel'))
    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('frontend/css/welcome.css') }}" rel="stylesheet">
</head>

<body>
    <div id='app'>
        <!-- nav-bar -->
        @include('frontend.includes.navbar')

        <!-- content -->
        @yield('content')

        <!-- footer -->
        @include('frontend.includes.footer')
    </div>
</body>

</html>