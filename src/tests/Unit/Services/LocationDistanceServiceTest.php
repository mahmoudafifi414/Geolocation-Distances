<?php

namespace Tests\Unit\Services;

use LocationBundle\DTOs\LocationDTOs\LocationDTO;
use LocationBundle\FactoryClasses\GeolocationProviders\GeolocationProvidersFactory;
use LocationBundle\FactoryClasses\GeolocationProviders\PositionStackProvider;
use LocationBundle\Services\LocationDistanceService;
use LocationBundle\Services\LocationDistanceSortingService;
use LocationBundle\Strategies\OutputStrategies\OutputStrategyContext;
use LocationBundle\ValueObjects\Location\LocationDistance;
use LocationBundle\ValueObjects\Location\LocationLatitude;
use LocationBundle\ValueObjects\Location\LocationLongitude;
use LocationBundle\ValueObjects\Location\LocationName;
use Tests\TestCase;

class LocationDistanceServiceTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetLocationsWithSortedDistances(): void
    {
        $positionStackProvider = $this->getMockBuilder(PositionStackProvider::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getLocationsDTOs'])
            ->getMock();

        $positionStackProvider->method('getLocationsDTOs')->willReturn($this->getLocationsDTOs());

        $geolocationFactory = $this->getMockBuilder(GeolocationProvidersFactory::class)
            ->disableOriginalConstructor()
            ->getMock();

        $geolocationFactory->method('makeGeolocationProvider')->willReturn($positionStackProvider);

        $locationDistanceService = new LocationDistanceService(
            new LocationDistanceSortingService(),
            $geolocationFactory,
            new OutputStrategyContext()
        );

        $result = $locationDistanceService->getLocationsWithSortedDistances();
        $this->assertEquals($this->getSortedLocationsDTOs(), $result);

    }

    public function testGetLocationDataToOutput()
    {
        $locationDistanceService = new LocationDistanceService(
            new LocationDistanceSortingService(),
            new GeolocationProvidersFactory(),
            new OutputStrategyContext()
        );

        $result = $locationDistanceService->getLocationDataToOutput($this->getSortedLocationsDTOs());
        $this->assertEquals($this->getSortedLocationDTOsArray(),$result);
    }

    /**
     * @return LocationDTO[]
     */
    private function getLocationsDTOs(): array
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

        return ['TestLocation1' => $locationDTO1, 'TestLocation2' => $locationDTO2, 'TestLocation3' => $locationDTO3];
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

    /**
     * @return array[]
     */
    private function getSortedLocationDTOsArray(): array
    {
        return[
          [
              1,
              '200 km',
              'TestLocation2',
              'TestLocation2'
          ], [
              2,
              '300 km',
              'TestLocation1',
              'TestLocation1'
          ] ,[
              3,
              '400 km',
              'TestLocation3',
              'TestLocation3'
          ]
        ];
    }
}
