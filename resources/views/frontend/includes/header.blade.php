<header class="text-center h-100">
    <div class="container h-100 d-flex justify-content-center align-items-center flex-column">
        <p class="site-title-sub display-5">Sample blog project featuring many basic and general topics.</p>
        <h1 class="d-md-4 display-2 site-title">{{ config('app.name', 'Laravel') }}</h1>
        <p class="site-description display-5">Check out come of my works.</p>
        <div class="row w-100 d-flex justify-content-center">
            <a href="{{ url('/') }}" class="btn btn-primary col-4 col-sm-3 col-md-2">Primary</a>
            <a href="{{ url('/') }}" class="btn btn-secondary offset-1 col-4 col-sm-3 col-md-2">Secondary</a>
        </div>
    </div>
</header>