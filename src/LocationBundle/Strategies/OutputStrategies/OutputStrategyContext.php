<?php

namespace LocationBundle\Strategies\OutputStrategies;

class OutputStrategyContext
{
    /**
     * @param string $outputStrategy
     * @return IOutputStrategy
     */
    public function process(string $outputStrategy): IOutputStrategy
    {
        return match ($outputStrategy) {
            'csv' => new CSVOutputStrategy(),
        };
    }
}
