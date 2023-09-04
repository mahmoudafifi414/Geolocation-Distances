<?php

namespace LocationBundle\FactoryClasses\GeolocationProviders;

class GeolocationProvidersFactory implements IGeolocationProvidersFactory
{
    /**
     * @return GeolocationProviders
     */
    public function makeGeolocationProvider(): GeolocationProviders
    {
        return new PositionStackProvider();
    }
}
