<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use LocationBundle\Exceptions\LocationException;
use LocationBundle\Services\Contracts\ILocationDistanceService;
use LocationBundle\Services\LocationDistanceService;
use Throwable;

class ListLocationDistances extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:list-location-distances';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command for list distances from specific location and ordering them based on that';

    /**
     * @param LocationDistanceService $locationDistancesService
     * @return void
     */
    public function handle(ILocationDistanceService $locationDistancesService): void
    {
        try {
            $locationDTOs = $locationDistancesService->getSortedLocationsDistances();
            $locationArrayData = $locationDistancesService->getLocationDataToOutput($locationDTOs);
            $locationDistancesService->setCSVDataOutput($locationArrayData);
            $this->showLocationSortingResults($locationArrayData);
        }catch (Throwable $throwable){
            $this->warn($throwable instanceof LocationException ? $throwable->getMessage() : 'Error Happened');
        }
    }

    /**
     * @param array $locationArrayData
     * @return void
     */
    private function showLocationSortingResults(array $locationArrayData): void
    {
        $this->table(config('geolocation.TABLE_COLUMNS_HEADINGS'), $locationArrayData);
    }
}
