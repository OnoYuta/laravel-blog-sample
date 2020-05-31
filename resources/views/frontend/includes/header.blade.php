<header class="text-center h-100">
    <div class="container h-100 d-flex justify-content-center align-items-center flex-column">
        <p class="site-title-sub display-5">Sample blog project featuring many basic and general topics.</p>
        <h1 class="d-md-4 display-2 site-title">{{ config('app.name', 'Laravel') }}</h1>
        <p class="site-description display-5">Check out come of my works.</p>
        <div class="btn-group row w-100 justify-content-center" role="group">
            <div class="col-xl-3 col-lg-4 col-md-5 col-12 mb-2 text-md-right">
                {{Form::open(['route' => 'login'])}}
                {{Form::hidden('username', config('account.sample.user.username'))}}
                {{Form::hidden('password', config('account.sample.user.password'))}}
                {{Form::submit(__('Login With Sample Account'), ['class' => 'btn btn-primary col', 'dusk' => 'sampleLoginBtn'])}}
            </div>
            <div class="col-xl-3 col-lg-4 col-md-5 col-12 text-md-left">
                <a href="{{ route('login') }}" class="btn btn-success col">{{ __('Show Login Form') }}</a>
            </div>
        </div>
    </div>
</header>