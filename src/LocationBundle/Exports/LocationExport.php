<?php

namespace LocationBundle\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

readonly class LocationExport implements FromCollection, WithHeadings
{
    /**
     * @param array $data
     */
    public function __construct(private array $data)
    {
    }

    /**
     * @return Collection
     */
    public function collection(): Collection
    {
        return collect($this->data);
    }

    /**
     * @return string[]
     */
    public function headings() :array
    {
        return config('geolocation.TABLE_COLUMNS_HEADINGS');
    }
}
