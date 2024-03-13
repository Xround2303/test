<?php

namespace App\Providers;
use App\Repository\RepositoryRestApp;
use App\Repository\RepositoryRestUser;
use Illuminate\Support\ServiceProvider;


class RepositoryProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Interface\InterfaceRepositoryUser::class, function ($app) {
            return $app->make(RepositoryRestUser::class);
        });
        $this->app->bind(\App\Interface\InterfaceRepositoryRestApp::class, function ($app) {
            return $app->make(RepositoryRestApp::class);
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
    }
}
