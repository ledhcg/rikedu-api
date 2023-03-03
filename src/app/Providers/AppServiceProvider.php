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
        $this->app->bind(AuthService::class, function ($app) {
            return new AuthService();
        });
        $this->app->bind(UserService::class, function ($app) {
            return new UserService();
        });
        $this->app->bind(PostService::class, function ($app) {
            return new PostService();
        });
        $this->app->bind(InfoService::class, function ($app) {
            return new InfoService();
        });
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