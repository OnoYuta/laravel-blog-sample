<nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
    <div class="container">
        <a href="{{ url('/') }}" class="navbar-brand"><i class="fas fa-braille"></i> @yield('title')</a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#mainNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="navbar-nav ml-auto">
                @guest
                <li class="nav-item ml-auto">
                    <a class="nav-link" href="{{ route('admin.login') }}">{{ __('Login') }}</a>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>