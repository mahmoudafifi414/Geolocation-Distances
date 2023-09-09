<?php
namespace LocationBundle\Services\Contracts;

interface ILocationDistanceService
{
    /**
     * @return array
     */
    public function getLocationsWithSortedDistances(): array;

    /**
     * @param array $locationsDTOs
     * @return array
     */
    public function getLocationDataToOutput(array $locationsDTOs): array;

    /**
     * @param array $locationDataArray
     * @return void
     */
    public function setCSVDataOutput(array $locationDataArray): void;
}
