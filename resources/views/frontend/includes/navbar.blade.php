<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand"><i class="fas fa-braille"></i> @yield('title')</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ml-auto">
                @if (Route::has('login'))
                @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">{{ __('Home') }}</a>
                </li>
                @else
                <li class="nav-item ml-auto">
                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                @if (Route::has('register'))
                <li class="nav-item ml-auto">
                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                </li>
                @endif
                @endauth
                @endif
                <li class="nav-item">
            </ul>
        </div>
    </div>
</nav>