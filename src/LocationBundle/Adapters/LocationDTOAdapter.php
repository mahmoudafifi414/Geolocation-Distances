<?php

namespace LocationBundle\Adapters;

use LocationBundle\DTOs\LocationDTOs\LocationDTO;
use LocationBundle\ValueObjects\Location\LocationDistance;
use LocationBundle\ValueObjects\Location\LocationLatitude;
use LocationBundle\ValueObjects\Location\LocationLongitude;
use LocationBundle\ValueObjects\Location\LocationName;

readonly class LocationDTOAdapter
{
    /**
     * @param $location
     * @param LocationDTO|null $destinationDTO
     * @return LocationDTO
     */
    public static function convertToDTO($location, ?LocationDTO $destinationDTO): LocationDTO
    {
        return new LocationDTO(
            LocationName::of($location->name),
            LocationLatitude::of($location->latitude),
            LocationLongitude::of($location->longitude),
            $destinationDTO ?
                LocationDistance::calculateDistanceInMeters($destinationDTO, $location->latitude, $location->longitude)
                : LocationDistance::of(0)
        );
    }
}
