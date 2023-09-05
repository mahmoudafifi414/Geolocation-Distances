<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use LocationBundle\FactoryClasses\GeolocationProviders\GeolocationProvidersFactory;
use LocationBundle\FactoryClasses\GeolocationProviders\IGeolocationProvidersFactory;

class LocationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IGeolocationProvidersFactory::class, GeolocationProvidersFactory::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}
