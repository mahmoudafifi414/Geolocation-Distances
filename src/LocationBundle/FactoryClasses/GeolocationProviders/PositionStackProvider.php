<?php

namespace LocationBundle\FactoryClasses\GeolocationProviders;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use LocationBundle\DTOs\LocationDTOs\LocationDTO;
use LocationBundle\Exceptions\NoDestinationDataException;
use LocationBundle\Exceptions\NoOriginDataException;

class PositionStackProvider extends GeolocationProviders
{
    /**
     * @var Client|null
     */
    private ?Client $client = null;
    /**
     * @return array
     * @throws GuzzleException
     * @throws NoDestinationDataException
     * @throws NoOriginDataException
     */
    public function getLocationsDTOs(): array
    {
        $originLocationsDTOObjects = [];
        $destinationLocationDTO = $this->getDestinationLocationDTO();
        // request one by one (not batch) because position stack free plan don't permit batch request
        foreach ($this->getDefinedOriginLocations() as $originLocation) {
            $locationData = $this->getLocationGeolocationData($originLocation);
            if ($locationData) {
                $originLocationsDTOObjects[] = $this->convertToLocationDTO($locationData[0], $destinationLocationDTO);
            }
        }

        if (empty($originLocationsDTOObjects)) {
            throw new NoOriginDataException(config('geolocation.EXCEPTION_MESSAGES.NO_ORIGIN_DATA'));
        }

        return $originLocationsDTOObjects;
    }

    /**
     * @return Client
     */
    private function getGuzzleClientInstance(): Client
    {
        if (NULL === $this->client) {
            $this->client = new Client();
        }
        return $this->client;
    }

    /**
     * @param string $definedLocation
     * @return array
     * @throws GuzzleException
     */
    private function getLocationGeolocationData(string $definedLocation): array
    {
        $response= $this->getGuzzleClientInstance()->request('GET', config('geolocation.POSITIONSTACK_V1_API_URL'),
            [
                'query' => [
                    'access_key' => config('geolocation.POSITIONSTACK_API_KEY'),
                    'query' => $definedLocation
                ]
            ]);

        return json_decode($response->getBody()?->getContents())->data;
    }

    /**
     * @return LocationDTO
     * @throws GuzzleException
     * @throws NoDestinationDataException
     */
    private function getDestinationLocationDTO(): LocationDTO
    {
        $destinationLocationData = $this->getLocationGeolocationData($this->getDefinedDestinationLocation());
        if (!$destinationLocationData) {
            throw new NoDestinationDataException(config('geolocation.EXCEPTION_MESSAGES.NO_DESTINATION_DATA'));
        }

        return $this->convertToLocationDTO($destinationLocationData[0]);
    }
}
