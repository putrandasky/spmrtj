<?php

namespace App\Exports;

use App\Respondent;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class AdditionalConcern implements FromView, WithTitle, ShouldAutoSize
{


    public function view(): View
    {
            $respondent = Respondent::where('step_id', 5)
                ->with('mrt_improvements','reason_using_transportations','work_place_parking_system','willingness_public_transport_trip')->get();
            return view('exports.additional_data',['respondents' => $respondent]);


    }
    public function title(): string
    {
        return "Additional Data";
    }
}
