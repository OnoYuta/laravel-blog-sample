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

    <!-- DNS-prefetch -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('frontend/css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id='app' class="vh-100 d-flex flex-column">
        <!-- nav-bar -->
        @include('frontend.includes.navbar')

        <!-- content -->
        <main>
            @yield('content')
        </main>

        <!-- footer -->
        @include('frontend.includes.footer')
    </div>
</body>

</html>