<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\SosioConcern;
use App\Exports\TripConcern;
use App\Exports\SpConcern;
use App\Exports\AdditionalConcern;
use App\Exports\PersonalConcern;

class BaseExport implements WithMultipleSheets
{

    public function sheets(): array
    {
        $sheets = [];

        // $sheets[] = new SosioConcern();
        // $sheets[] = new TripConcern();
        $sheets[] = new AdditionalConcern();
        // $sheets[] = new PersonalConcern();

        return $sheets;
    }
}
