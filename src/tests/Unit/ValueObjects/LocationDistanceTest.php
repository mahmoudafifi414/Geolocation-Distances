<?php

namespace Tests\Unit\ValueObjects;

use LocationBundle\DTOs\LocationDTOs\LocationDTO;
use LocationBundle\ValueObjects\Location\LocationDistance;
use LocationBundle\ValueObjects\Location\LocationLatitude;
use LocationBundle\ValueObjects\Location\LocationLongitude;
use LocationBundle\ValueObjects\Location\LocationName;
use Tests\TestCase;

class LocationDistanceTest extends TestCase
{
    /**
     * @return void
     */
    public function testCalculateDistanceInMeters()
    {
        $result = LocationDistance::calculateDistanceInMeters($this->getDestinationDTO(), '50.1', '60.241');
        $this->assertEquals(new LocationDistance('4447.42'), $result);
    }

    /**
     * @return LocationDTO
     */
    private function getDestinationDTO(): LocationDTO
    {
         return new LocationDTO(
            LocationName::of('DestinationLocation'),
            LocationLatitude::of('90.1'),
            LocationLongitude::of('70.1'),
            LocationDistance::of(0));
    }
}
