<?php

namespace App\Exports;

use App\Respondent;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class SimulationMrtConcern implements FromView, WithTitle, ShouldAutoSize
{

    public function view(): View
    {
        $respondents = Respondent::whereHas('station_respondents')->where('step_id', '>', 3)->where('simulation_id', 2)->with('station_respondents.station')->get();
        return view('exports.simulation', ['respondents' => $respondents]);
    }
    public function title(): string
    {
        return 'SimulationMRT';
    }
}
