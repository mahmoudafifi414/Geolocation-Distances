<?php

namespace LocationBundle\Strategies\OutputStrategies;

use LocationBundle\Exports\LocationExport;
use Maatwebsite\Excel\Facades\Excel;

class CSVOutputStrategy implements IOutputStrategy
{

    /**
     * @param array $dataToOutput
     * @return bool
     */
    public function output(array $dataToOutput): bool
    {
        return Excel::store(new LocationExport($dataToOutput), config('geolocation.OUTPUT_STRATEGY_FILE_NAME'));
    }
}
