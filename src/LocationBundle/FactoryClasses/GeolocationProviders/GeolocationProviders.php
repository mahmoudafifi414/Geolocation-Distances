<?php

namespace LocationBundle\FactoryClasses\GeolocationProviders;

use LocationBundle\Adapters\LocationDTOAdapter;
use LocationBundle\DTOs\LocationDTOs\LocationDTO;

abstract class GeolocationProviders
{
    /**
     * @return array
     */
    protected abstract function getLocationsDTOs(): array;

    /**
     * @param $locationData
     * @param LocationDTO|null $destinationData
     * @return LocationDTO
     */
    protected function convertToLocationDTO($locationData, ?LocationDTO $destinationData = null): LocationDTO
    {
        return LocationDTOAdapter::convertToDTO($locationData, $destinationData);
    }

    /**
     * @return string
     */
    protected function getDefinedDestinationLocation(): string
    {
        return config('geolocation.LOCATIONS.DESTINATION');
    }

    /**
     * @return array
     */
    protected function getDefinedOriginLocations(): array
    {
        return config('geolocation.LOCATIONS.ORIGIN');
    }
}
