<?php

namespace App\Exports;

use App\Respondent;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class SimulationFeederAndMrtConcern implements FromView, WithTitle, ShouldAutoSize
{

    public function view(): View
    {
        $respondents = Respondent::whereHas('station_respondents')->where('step_id', '>', 3)->where('simulation_id', 4)->with('station_respondents.station')->get();
        return view('exports.simulation_feeder_and_mrt', ['respondents' => $respondents]);
    }
    public function title(): string
    {
        return 'SimulationFeederAndMRT';
    }
}
