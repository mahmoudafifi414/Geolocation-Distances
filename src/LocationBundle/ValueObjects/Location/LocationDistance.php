<?php

namespace LocationBundle\ValueObjects\Location;

use LocationBundle\DTOs\LocationDTOs\LocationDTO;
use LocationBundle\ValueObjects\FloatValue;

final class LocationDistance extends FloatValue
{
    /**
     * @param LocationDTO $destinationDTO
     * @param float $originLat
     * @param float $originLong
     * @return LocationDistance
     */
    public static function calculateDistanceInMeters(LocationDTO $destinationDTO, float $originLat, float $originLong): self
    {
        $theta = $destinationDTO->getLocationLongitude() - $originLong;
        $dist = sin(deg2rad($destinationDTO->getLocationLatitude())) * sin(deg2rad($originLat)) +
            cos(deg2rad($destinationDTO->getLocationLatitude())) * cos(deg2rad($originLat)) * cos(deg2rad($theta));
        $dist = acos($dist);
        $dist = rad2deg($dist);
        $twoDecimalNumber = number_format($dist * 60 * 1.1515 * 1.609344, 2, '.', '');

        return self::of($twoDecimalNumber);
    }
}
