<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

use App;

class PersonalConcern implements FromCollection, WithHeadings,WithMapping,ShouldAutoSize,WithTitle
{
  use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
        public function map($respondent): array
    {
        return [
            $respondent->id,
            $respondent->name,
            $respondent->phone,
            $respondent->email,
            $respondent->address,
            $respondent->comment,
        ];
    }
        public function headings(): array
    {
        return [
            'id',
            'Nama',
            'Phone',
            'Email',
            'Alamat',
            'Harapan',


        ];
    }
    public function collection()
    {
        return App\Respondent::where('step_id',5)->whereNotNull('phone')->get();
        // return Respondent::select('id','gender','age_id')->get();
    }
    public function title(): string
    {
        return "Personal Data";
    }
}
