<header class="text-center h-100">
    <div class="container h-100 d-flex justify-content-center align-items-center flex-column">
        <p class="site-title-sub display-5">Sample blog project featuring many basic and general topics.</p>
        <h1 class="d-md-4 display-2 site-title">{{ config('app.name', 'Laravel') }}</h1>
        <p class="site-description display-5">Check out come of my works.</p>
        <div class="row w-100 d-flex justify-content-center">
            <div class="col-4 col-sm-3 col-md-2">
                {{Form::open(['route' => 'login'])}}
                {{Form::hidden('username', config('account.sample.user.username'))}}
                {{Form::hidden('password', config('account.sample.user.password'))}}
                {{Form::submit(__('Login With Sample Account'), ['class' => 'btn btn-primary', 'dusk' => 'sampleLoginBtn'])}}
            </div>
            <a href="{{ route('login') }}" class="btn btn-secondary offset-1 col-4 col-sm-3 col-md-2">ログインフォームを開く</a>
        </div>
    </div>
</header>