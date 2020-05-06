<?php

namespace App\Exports;

use App\Respondent;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class SpConcern implements FromView, WithTitle, ShouldAutoSize
{

    private $sp_id;

    public function __construct($sp_id)
    {
        $this->sp_id = $sp_id;
    }
    public function view(): View
    {

        if ($this->sp_id == 1) {
            # code...
            $respondent = Respondent::whereHas('sp_pedestrians')->where('step_id', '>', 3)
                ->with('sp_pedestrians')->get();
            return view('exports.sp_pedestrian',['respondents' => $respondent]);
        }
        if ($this->sp_id == 2) {
            # code...
            $respondent = Respondent::whereHas('sp_cycles')->where('step_id', '>', 3)
                ->with('sp_cycles')->get();
            return view('exports.sp_cycle', ['respondents' => $respondent]);
        }
        if ($this->sp_id == 3) {
            # code...
            $respondent = Respondent::whereHas('sp_car_parkings')->where('step_id', '>', 3)
                ->with('sp_car_parkings')->get();
            return view('exports.sp_car_parking',['respondents' => $respondent]);
        }
        if ($this->sp_id == 4) {
            # code...
            $respondent = Respondent::whereHas('sp_motor_parkings')->where('step_id', '>', 3)
                ->with('sp_motor_parkings')->get();
            return view('exports.sp_motor_parking',['respondents' => $respondent]);
        }
        if ($this->sp_id == 5) {
            # code...
            $respondent = Respondent::whereHas('sp_feeder_regulers')->whereHas('sp_feeder_premia')->where('step_id', '>', 3)
                ->with('sp_feeder_regulers', 'sp_feeder_premia')->get();
            return view('exports.sp_feeder',['respondents' => $respondent]);
        }
        if ($this->sp_id == 7) {
            # code...
            $respondent = Respondent::whereHas('sp_feeder_parks')->where('step_id', '>', 3)->with('sp_feeder_parks')->get();
            return view('exports.sp_feeder_park',['respondents' => $respondent]);
        }
        if ($this->sp_id == 9) {
            # code...
            $respondent = Respondent::whereHas('sp_park_ride_primary_cars')->where('step_id', '>', 3)->with('sp_park_ride_primary_cars','sp_park_ride_commons')->get();
            return view('exports.sp_pr_car',['respondents' => $respondent]);
        }
        if ($this->sp_id == 10) {
            # code...
            $respondent = Respondent::whereHas('sp_park_ride_primary_motors')->where('step_id', '>', 3)->with('sp_park_ride_primary_motors','sp_park_ride_commons')->get();
            return view('exports.sp_pr_motor',['respondents' => $respondent]);
        }
        if ($this->sp_id == 11) {
          # code...
          $respondent = Respondent::whereHas('sp_park_ride_hypo_cars')->where('step_id', '>', 3)->with('sp_park_ride_hypo_cars','sp_park_ride_commons')->get();
          return view('exports.sp_pr_car_hypo',['respondents' => $respondent]);
      }
        if ($this->sp_id == 12) {
          # code...
          $respondent = Respondent::whereHas('sp_park_ride_hypo_motors')->where('step_id', '>', 3)->with('sp_park_ride_hypo_motors','sp_park_ride_commons')->get();
          return view('exports.sp_pr_motor_hypo',['respondents' => $respondent]);
      }

    }
    public function title(): string
    {
        return $this->sp_id == 1 ? "Pedestrian" :
        ($this->sp_id == 2 ? "Cycle" :
            ($this->sp_id == 3 ? "Park Car" :
                ($this->sp_id == 4 ? "Park Motor" :
                    ($this->sp_id == 5 ? "Feeder" :
                        ($this->sp_id == 7 ? "Feeder Park" :
                            ($this->sp_id == 9 ? "Park Ride Car" :
                                ($this->sp_id == 10 ? "Park Ride Motor" :
                                    ($this->sp_id == 11 ? "Park Ride Car (Hypo)" :
                                        ($this->sp_id == 12 ? "Park Ride Motor (Hypo)" : null)))))))));
    }
}
