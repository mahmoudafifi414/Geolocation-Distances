<?php

namespace LocationBundle\FactoryClasses\GeolocationProviders;

interface IGeolocationProvidersFactory
{
    /**
     * @return GeolocationProviders
     */
    public function makeGeolocationProvider(): GeolocationProviders;
}
