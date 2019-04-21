<?php

namespace Hadesker\SocialApi;

use Illuminate\Support\ServiceProvider;

class SocialApiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (! $this->app->routesAreCached()) {
            include __DIR__ . '/routes.php';
        }

        $this->publishes([
            __DIR__.'/SocialApiController.php' => app_path('Http/Controllers/Api/SocialApiController.php'),
        ]);
    }

    public function register()
    {
        $this->app->make('Hadesker\SocialApi\SocialApiController');
    }
}
