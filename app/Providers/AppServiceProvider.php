<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /*
         * Backend binding
         */
        $this->app->bind(
            \App\Repositories\Backend\Contract\PostRepositoryContract::class,
            \App\Repositories\Backend\Repository\EloquentPostRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
