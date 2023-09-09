<?php

namespace LocationBundle\Services\Contracts;

interface ILocationDistanceSortingService
{
    /**
     * @param array $locations
     * @return array
     */
    public function getSortedLocationsDistances(array $locations): array;
}
