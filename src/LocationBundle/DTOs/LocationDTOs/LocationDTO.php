<?php

namespace LocationBundle\DTOs\LocationDTOs;

use LocationBundle\DTOs\DTO;
use LocationBundle\ValueObjects\Location\LocationDistance;
use LocationBundle\ValueObjects\Location\LocationLabel;
use LocationBundle\ValueObjects\Location\LocationLatitude;
use LocationBundle\ValueObjects\Location\LocationLongitude;
use LocationBundle\ValueObjects\Location\LocationName;

readonly class LocationDTO implements DTO
{
    /**
     * @param LocationName $locationName
     * @param LocationLatitude $locationLatitude
     * @param LocationLongitude $locationLongitude
     * @param LocationLabel $locationLabel
     * @param LocationDistance $locationDistance
     */
    public function __construct
    (
        private LocationName      $locationName,
        private LocationLatitude  $locationLatitude,
        private LocationLongitude $locationLongitude,
        private LocationLabel     $locationLabel,
        private LocationDistance  $locationDistance
    )
    {
    }

    /**
     * @return string
     */
    public function getLocationName(): string
    {
        return $this->locationName->getValue();
    }

    /**
     * @return float
     */
    public function getLocationLatitude(): float
    {
        return $this->locationLatitude->getValue();
    }

    /**
     * @return float
     */
    public function getLocationLongitude(): float
    {
        return $this->locationLongitude->getValue();
    }

    /**
     * @return string
     */
    public function getLocationLabel(): string
    {
        return $this->locationLabel->getValue();
    }

    /**
     * @return float
     */
    public function getLocationDistance(): float
    {
        return $this->locationDistance->getValue();
    }
}
