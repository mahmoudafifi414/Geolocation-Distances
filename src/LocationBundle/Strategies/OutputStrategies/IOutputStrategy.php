<?php

namespace LocationBundle\Strategies\OutputStrategies;

interface IOutputStrategy
{
    /**
     * @param array $dataToOutput
     * @return bool
     */
    public function output(array $dataToOutput): bool;
}
