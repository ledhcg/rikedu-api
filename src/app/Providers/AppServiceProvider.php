<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        AuthController::class => AuthService::class,
        UserController::class => UserService::class,
        PostController::class => PostService::class,
        InfoController::class => InfoService::class,
    ];

    /**
     * All of the container singletons that should be registered.
     *
     * @var array
     */
    public $singletons = [
        UserService::class => ImageService::class,
        PostService::class => ImageService::class,
        InfoService::class => ImageService::class,
        AboutService::class => ImageService::class,
    ];
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
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
