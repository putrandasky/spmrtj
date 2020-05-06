<?php

namespace App\Exports;

use App\Respondent;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class TripConcern implements FromView, WithTitle, ShouldAutoSize
{

    public function view(): View
    {
        $respondent = Respondent::where('step_id', '>', 3)
            ->with('parking_guarantor', 'travel_purpose', 'travel_details.transportation_mode')
            ->withCount('travel_details')
            ->get();
        return view('exports.trip',
            [
                'respondents' => $respondent,
                'max_travel_detail' => $respondent->max('travel_details_count'),

            ]);
    }
    public function title(): string
    {
        return 'Trip';
    }
}
