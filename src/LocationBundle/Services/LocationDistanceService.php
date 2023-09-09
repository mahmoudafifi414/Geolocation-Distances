<?php
namespace LocationBundle\Services;
use LocationBundle\Adapters\LocationDataAdapter;
use LocationBundle\FactoryClasses\GeolocationProviders\IGeolocationProvidersFactory;
use LocationBundle\Services\Contracts\ILocationDistanceService;
use LocationBundle\Services\Contracts\ILocationDistanceSortingService;
use LocationBundle\Strategies\OutputStrategies\OutputStrategyContext;

readonly class LocationDistanceService implements ILocationDistanceService
{

    /**
     * @param ILocationDistanceSortingService $locationDistanceSortingService
     * @param IGeolocationProvidersFactory $geolocationProvidersFactory
     * @param OutputStrategyContext $outputStrategyContext
     */
    public function __construct
    (

        private ILocationDistanceSortingService $locationDistanceSortingService,
        private IGeolocationProvidersFactory $geolocationProvidersFactory,
        private OutputStrategyContext $outputStrategyContext,
    )
    {
    }

    /**
     * @return array
     */
    public function getLocationsWithSortedDistances(): array
    {
        $geolocationProvider = $this->geolocationProvidersFactory->makeGeolocationProvider();
        $locationsDTOs = $geolocationProvider->getLocationsDTOs();
        return $this->locationDistanceSortingService->getSortedLocationsDistances($locationsDTOs);
    }

    /**
     * @param array $locationsDTOs
     * @return array
     */
    public function getLocationDataToOutput(array $locationsDTOs): array
    {
        $locationArrayData = [];
        $sortNumber = 1;
        foreach ($locationsDTOs as $address => $locationDTO){
            $locationArrayData[] = LocationDataAdapter::convertToArray($sortNumber, $address, $locationDTO);
            $sortNumber++;
        }

        return $locationArrayData;
    }

    /**
     * @param array $locationDataArray
     * @return void
     */
    public function setCSVDataOutput(array $locationDataArray): void
    {
        $csvOutputStrategy = $this->outputStrategyContext->process(config('geolocation.OUTPUT_STRATEGY'));
        $csvOutputStrategy->output($locationDataArray);
    }
}
