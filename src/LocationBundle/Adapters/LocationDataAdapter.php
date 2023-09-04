<?php

namespace LocationBundle\Adapters;

use LocationBundle\DTOs\LocationDTOs\LocationDTO;

readonly class LocationDataAdapter
{
    /**
     * @param int $iteration
     * @param string $address
     * @param LocationDTO $locationDTO
     * @return array
     */
    public static function convertToArray(int $iteration, string $address, LocationDTO $locationDTO): array
    {
        return [
            $iteration,
            $locationDTO->getLocationDistance() . ' ' .config('geolocation.UNIT.KM'),
            $locationDTO->getLocationName(),
            $address
        ];
    }
}
