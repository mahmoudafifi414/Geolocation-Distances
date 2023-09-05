<?php

namespace Tests\Unit\Services;

use LocationBundle\DTOs\LocationDTOs\LocationDTO;
use LocationBundle\Services\LocationDistanceSortingService;
use LocationBundle\ValueObjects\Location\LocationDistance;
use LocationBundle\ValueObjects\Location\LocationLatitude;
use LocationBundle\ValueObjects\Location\LocationLongitude;
use LocationBundle\ValueObjects\Location\LocationName;
use Tests\TestCase;

class LocationDistanceSortingServiceTest extends TestCase
{
    public function testGetSortedLocationsDistances()
    {
        $locationDistanceSortingService = new LocationDistanceSortingService();
        $result = $locationDistanceSortingService->getSortedLocationsDistances($this->getSortedLocationsDTOs());
        $this->assertEquals($this->getSortedLocationsDTOs(),$result);
    }

    /**
     * @return LocationDTO[]
     */
    private function getSortedLocationsDTOs(): array
    {
        $locationDTO1 = new LocationDTO(
            LocationName::of('TestLocation1'),
            LocationLatitude::of('90.1'),
            LocationLongitude::of('70.1'),
            LocationDistance::of(300));
        $locationDTO2 = new LocationDTO(
            LocationName::of('TestLocation2'),
            LocationLatitude::of('60.1'),
            LocationLongitude::of('50.1'),
            LocationDistance::of(200));
        $locationDTO3 = new LocationDTO(
            LocationName::of('TestLocation3'),
            LocationLatitude::of('20.1'),
            LocationLongitude::of('10.1'),
            LocationDistance::of(400));

        return ['TestLocation2' => $locationDTO2, 'TestLocation1' => $locationDTO1, 'TestLocation3' => $locationDTO3];
    }
}
