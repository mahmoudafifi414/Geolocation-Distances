<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use LocationBundle\FactoryClasses\GeolocationProviders\GeolocationProvidersFactory;
use LocationBundle\FactoryClasses\GeolocationProviders\IGeolocationProvidersFactory;
use LocationBundle\Services\Contracts\ILocationDistanceService;
use LocationBundle\Services\Contracts\ILocationDistanceSortingService;
use LocationBundle\Services\LocationDistanceService;
use LocationBundle\Services\LocationDistanceSortingService;

class LocationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IGeolocationProvidersFactory::class, GeolocationProvidersFactory::class);
        $this->app->bind(ILocationDistanceService::class, LocationDistanceService::class);
        $this->app->bind(ILocationDistanceSortingService::class, LocationDistanceSortingService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {

    }
}
