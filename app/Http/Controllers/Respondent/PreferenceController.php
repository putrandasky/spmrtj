<?php

namespace App\Http\Controllers\Respondent;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PreferenceController extends Controller
{

    public function getParkCar()
    {
        $data['cost_preferences'] = App\CostPreference::where('sp_type','park_car')->get();
        $data['time_preferences'] = App\TimePreference::where('sp_type','park_car')->get();
        return $data;
    }
    public function getParkMotor()
    {
        $data['cost_preferences'] = App\CostPreference::where('sp_type','park_motor')->get();
        $data['time_preferences'] = App\TimePreference::where('sp_type','park_motor')->get();
        return $data;
    }
    public function getFeeder()
    {
        $data['cost_preferences'] = App\CostPreference::where('sp_type','feeder')->get();
        $data['time_preferences'] = App\TimePreference::where('sp_type','feeder')->get();
        return $data;
    }
    public function getFeederPremium()
    {
        $data['cost_preferences'] = App\CostPreference::where('sp_type','feeder_premium')->get();
        return $data;
    }
    public function getParkRideCar()
    {
        $data['cost_preferences'] = App\CostPreference::where('sp_type','park_ride_car')->get();
        return $data;
    }
    public function getParkRideMotor()
    {
        $data['cost_preferences'] = App\CostPreference::where('sp_type','park_ride_motor')->get();
        return $data;
    }
    public function getPedestrian()
    {
        $data = App\SpPedestrianChoice::all();
        return $data;
    }
    public function getCycle()
    {
        $data = App\SpCycleChoice::all();
        return $data;
    }

}
