<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

use App;

class SosioConcern implements FromCollection, WithHeadings,WithMapping,ShouldAutoSize
{
  use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
        public function map($respondent): array
    {
        return [
            $respondent->id,
            $respondent->age->description,
            $respondent->gender->description,
            $respondent->education->description,
            $respondent->job->description,
            $respondent->income->description,
            $respondent->expense->description,
            $respondent->travel_expense->description,
            $respondent->travel_guarantor->description,
            $respondent->license->description,
            $respondent->vehicle->description,
        ];
    }
        public function headings(): array
    {
        return [
            'id',
            'Gender',
            'Age',
            'Education',
            'Job',
            'Income',
            'Expense',
            'Travel Cost',
            'Guarantor',
            'License',
            'Vehicle',

        ];
    }
    public function collection()
    {
        return App\Respondent::where('step_id','>',3)
        ->with('age',
        'gender',
        'education',
        'job',
        'income',
        'expense',
        'travel_expense',
        'license',
        'vehicle')->get();
        // return Respondent::select('id','gender','age_id')->get();
    }
}
