<?php

namespace App\Exports;

use App\ParkRidePointRespondent;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class ParkRidePointConcern implements FromView, WithTitle, ShouldAutoSize
{

    public function view(): View
    {
        $respondent = ParkRidePointRespondent::with('park_ride_point')
            ->get();
        return view('exports.park_ride_point',
            [
                'respondents' => $respondent,

            ]);
    }
    public function title(): string
    {
        return 'Park Ride Point';
    }
}
