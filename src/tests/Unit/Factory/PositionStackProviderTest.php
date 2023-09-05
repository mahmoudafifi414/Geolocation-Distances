<?php

namespace Tests\Unit\Factory;

use GuzzleHttp\Exception\GuzzleException;
use LocationBundle\DTOs\LocationDTOs\LocationDTO;
use LocationBundle\Exceptions\NoDestinationDataException;
use LocationBundle\Exceptions\NoOriginDataException;
use LocationBundle\FactoryClasses\GeolocationProviders\PositionStackProvider;
use LocationBundle\ValueObjects\Location\LocationDistance;
use LocationBundle\ValueObjects\Location\LocationLatitude;
use LocationBundle\ValueObjects\Location\LocationLongitude;
use LocationBundle\ValueObjects\Location\LocationName;
use ReflectionException;
use Tests\TestCase;
use stdClass;
use ReflectionClass;

class PositionStackProviderTest extends TestCase
{
    /**
     * @return void
     */
    public function testGetLocationsDTOs()
    {
        $positionStackProvider = $this->getMockBuilder(PositionStackProvider::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getDestinationLocationDTO', 'getGeolocationData', 'getDefinedOriginLocations'])
            ->getMock();

        $positionStackProvider->method('getDestinationLocationDTO')->willReturn($this->getDestinationDTO());
        $positionStackProvider->method('getDefinedOriginLocations')->willReturn($this->getDefinedOriginLocations());
        $positionStackProvider->method('getGeolocationData')->willReturn($this->getGeolocationData());
        $result = $positionStackProvider->getLocationsDTOs();
        $this->assertEquals($this->getExpectedLocationsDTOs(), $result);
    }

     /**
     * @return void
     */
    public function testGetLocationsDTOsThrowNoOriginDataException()
    {
        $this->expectException(NoOriginDataException::class);
        $positionStackProvider = $this->getMockBuilder(PositionStackProvider::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getDestinationLocationDTO', 'getGeolocationData', 'getDefinedOriginLocations'])
            ->getMock();

        $positionStackProvider->method('getDestinationLocationDTO')->willReturn($this->getDestinationDTO());
        $positionStackProvider->method('getDefinedOriginLocations')->willReturn($this->getDefinedOriginLocations());
        $positionStackProvider->method('getGeolocationData')->willReturn([]);
        $positionStackProvider->getLocationsDTOs();
    }

    /**
     * @throws ReflectionException
     */
    public function testGetDestinationLocationDTO()
    {
        $positionStackProvider = $this->getMockBuilder(PositionStackProvider::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getGeolocationData'])
            ->getMock();

        $positionStackProvider->method('getGeolocationData')->willReturn($this->getDestinationGeolocationData());

        $reflectionClass = new ReflectionClass($positionStackProvider);
        $method = $reflectionClass->getMethod('getDestinationLocationDTO');
        $this->assertEquals($this->getDestinationDTO(), $method->invoke($positionStackProvider));
    }

    /**
     * @throws ReflectionException
     */
    public function testGetDestinationLocationDTOWithNoDestinationDataException()
    {
        $this->expectException(NoDestinationDataException::class);
        $positionStackProvider = $this->getMockBuilder(PositionStackProvider::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getGeolocationData'])
            ->getMock();

        $positionStackProvider->method('getGeolocationData')->willReturn([]);

        $reflectionClass = new ReflectionClass($positionStackProvider);
        $method = $reflectionClass->getMethod('getDestinationLocationDTO');
        $method->invoke($positionStackProvider);
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

    /**
     * @return stdClass[]
     */
    private function getDestinationGeolocationData(): array
    {
        $destinationData = new stdClass();
        $destinationData->name = 'DestinationLocation';
        $destinationData->latitude = 90.1;
        $destinationData->longitude = 70.1;

        return [$destinationData];
    }

    /**
     * @return stdClass[]
     */
    private function getGeolocationData(): array
    {
        $originData = new stdClass();
        $originData->name = 'TestOriginLocation';
        $originData->latitude = 90.21;
        $originData->longitude = 70.33;

        return [$originData];
    }

    /**
     * @return string[]
     */
    private function getDefinedOriginLocations(): array
    {
        return ['TestOriginLocation'];
    }

    /**
     * @return LocationDTO
     */
    private function getOriginLocationDTO(): LocationDTO
    {
        return new LocationDTO(
            LocationName::of('TestOriginLocation'),
            LocationLatitude::of('90.21'),
            LocationLongitude::of('70.33'),
            LocationDistance::of(12.23));
    }

    /**
     * @return LocationDTO[]
     */
    private function getExpectedLocationsDTOs(): array
    {
        return [
            'TestOriginLocation' => $this->getOriginLocationDTO()
        ];
    }
}
