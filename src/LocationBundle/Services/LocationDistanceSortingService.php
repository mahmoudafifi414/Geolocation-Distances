<?php

namespace LocationBundle\Services;

use LocationBundle\DTOs\LocationDTOs\LocationDTO;
use LocationBundle\Services\Contracts\ILocationDistanceSortingService;

readonly class LocationDistanceSortingService implements ILocationDistanceSortingService
{
    /**
     * @param array $locations
     * @return array
     */
    public function getSortedLocationsDistances(array $locations): array
    {
        return collect($locations)->sortBy(function (LocationDTO $location){
            return $location->getLocationDistance();
        })->all();
    }
}
