<?php

namespace LocationBundle\Adapters;

use LocationBundle\DTOs\LocationDTOs\LocationDTO;

readonly class LocationDataAdapter
{
    /**
     * @param int $iteration
     * @param LocationDTO $locationDTO
     * @return array
     */
    public static function convertToArray(int $iteration, LocationDTO $locationDTO): array
    {
        return [
            $iteration,
            $locationDTO->getLocationDistance() . ' ' .config('geolocation.UNIT.KM'),
            $locationDTO->getLocationName(),
            $locationDTO->getLocationLabel()
        ];
    }
}
