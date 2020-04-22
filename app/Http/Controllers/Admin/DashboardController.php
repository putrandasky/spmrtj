<?php

namespace App\Http\Controllers\Admin;

use App;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::createFromTimestamp(Carbon::today()->subDays($i)->timestamp)->toDateString();
            $date2 = Carbon::createFromTimestamp(Carbon::today()->subDays($i)->timestamp)->format('d-M-y');
            $data['chart']['respondent_increment'][] = App\Respondent::whereDate('created_at', $date)->count();
            $data['chart']['respondent_increment_valid'][] = App\Respondent::where('step_id', '>', 3)->whereDate('created_at', $date)->count();
            // $data['chart']['cummulative_open_item_perdate'][] = $cummulative_item_perdate - $cummulative_closed_perdate;
            $data['chart']['respondent_cummulative'][] = App\Respondent::whereDate('created_at', '<=', $date)->count();
            $data['chart']['respondent_cummulative_valid'][] = App\Respondent::where('step_id', '>', 3)->whereDate('created_at', '<=', $date)->count();
            $data['chart']['date'][] = $date2;
        }
        $cost_preference_park_car_id = App\CostPreference::where('sp_type', 'park_car')->get()->pluck('id');
        $data['sp_car']['label']['cost'] = App\CostPreference::where('sp_type', 'park_car')->get()->pluck('amount');
        $time_preference_park_car_id = App\TimePreference::where('sp_type', 'park_car')->get()->pluck('id');
        $data['sp_car']['label']['time'] = App\TimePreference::where('sp_type', 'park_car')->get()->pluck('amount');
        for ($a = 0; $a < count($cost_preference_park_car_id); $a++) {
            $cost_id = $cost_preference_park_car_id[$a];
            $cost_name = $data['sp_car']['label']['cost'][$a];
            $data['sp_car']['data_set'][$a]['label'] = $cost_name;
            for ($i = 0; $i < count($time_preference_park_car_id); $i++) {
                $data['sp_car']['data_set'][$a]['chartData'][$i] = App\SpCarParking::where('cost_preference_id', $cost_id)
                    ->where('time_preference_id', $time_preference_park_car_id[$i])
                    ->where('respond', 1)
                    ->count();
            }
        }
        // $cost_preference_park_car_id = App\CostPreference::where('sp_type', 'park_car')->get()->pluck('id');
        // $data['sp_car']['label']['cost'] = App\CostPreference::where('sp_type', 'park_car')->get()->pluck('amount');
        // $time_preference_park_car_id = App\TimePreference::where('sp_type', 'park_car')->get()->pluck('id');
        // $data['sp_car']['label']['time'] = App\TimePreference::where('sp_type', 'park_car')->get()->pluck('amount');
        // for ($a = 0; $a < count($cost_preference_park_car_id); $a++) {
        //     $cost_id = $cost_preference_park_car_id[$a];
        //     $cost_name = $data['sp_car']['label']['cost'][$a];
        //     for ($i = 0; $i < count($time_preference_park_car_id); $i++) {
        //         $data['sp_car']['data'][$cost_name][$i] = App\SpCarParking::where('cost_preference_id', $cost_id)
        //             ->where('time_preference_id', $time_preference_park_car_id[$i])
        //             ->where('respond', 1)
        //             ->count();
        //     }
        // }

        $cost_preference_park_motor_id = App\CostPreference::where('sp_type', 'park_motor')->get()->pluck('id');
        $data['sp_motor']['label']['cost'] = App\CostPreference::where('sp_type', 'park_motor')->get()->pluck('amount');
        $time_preference_park_motor_id = App\TimePreference::where('sp_type', 'park_motor')->get()->pluck('id');
        $data['sp_motor']['label']['time'] = App\TimePreference::where('sp_type', 'park_motor')->get()->pluck('amount');
        for ($a = 0; $a < count($cost_preference_park_motor_id); $a++) {
            $cost_id = $cost_preference_park_motor_id[$a];
            $cost_name = $data['sp_motor']['label']['cost'][$a];
            $data['sp_motor']['data_set'][$a]['label'] = $cost_name;
            for ($i = 0; $i < count($time_preference_park_motor_id); $i++) {
                $data['sp_motor']['data_set'][$a]['chartData'][$i] = App\SpMotorParking::where('cost_preference_id', $cost_id)
                    ->where('time_preference_id', $time_preference_park_motor_id[$i])
                    ->where('respond', 1)
                    ->count();
            }
        }
        // $cost_preference_park_motor_id = App\CostPreference::where('sp_type', 'park_motor')->get()->pluck('id');
        // $data['sp_motor']['label']['cost'] = App\CostPreference::where('sp_type', 'park_motor')->get()->pluck('amount');
        // $time_preference_park_motor_id = App\TimePreference::where('sp_type', 'park_motor')->get()->pluck('id');
        // $data['sp_motor']['label']['time'] = App\TimePreference::where('sp_type', 'park_motor')->get()->pluck('amount');
        // for ($a = 0; $a < count($cost_preference_park_motor_id); $a++) {
        //     $cost_id = $cost_preference_park_motor_id[$a];
        //     $cost_name = $data['sp_motor']['label']['cost'][$a];
        //     for ($i = 0; $i < count($time_preference_park_motor_id); $i++) {
        //         $data['sp_motor']['data'][$cost_name][$i] = App\SpMotorParking::where('cost_preference_id', $cost_id)
        //             ->where('time_preference_id', $time_preference_park_motor_id[$i])
        //             ->where('respond', 1)
        //             ->count();
        //     }
        // }
        $cost_preference_feeder_id = App\CostPreference::where('sp_type', 'feeder')->get()->pluck('id');
        $data['sp_feeder']['label']['cost'] = App\CostPreference::where('sp_type', 'feeder')->get()->pluck('amount');
        $time_preference_feeder_id = App\TimePreference::where('sp_type', 'feeder')->get()->pluck('id');
        $data['sp_feeder']['label']['time'] = App\TimePreference::where('sp_type', 'feeder')->get()->pluck('amount');
        for ($a = 0; $a < count($cost_preference_feeder_id); $a++) {
            $cost_id = $cost_preference_feeder_id[$a];
            $cost_name = $data['sp_feeder']['label']['cost'][$a];
            $data['sp_feeder']['data_set'][$a]['label'] = $cost_name;
            for ($i = 0; $i < count($time_preference_feeder_id); $i++) {
                $data['sp_feeder']['data_set'][$a]['chartData'][$i] = App\SpFeederReguler::where('cost_preference_id', $cost_id)
                    ->where('time_preference_id', $time_preference_feeder_id[$i])
                    ->where('respond', 1)
                    ->count();
            }
        }
        // $cost_preference_feeder_id = App\CostPreference::where('sp_type', 'feeder')->get()->pluck('id');
        // $data['sp_feeder']['label']['cost'] = App\CostPreference::where('sp_type', 'feeder')->get()->pluck('amount');
        // $time_preference_feeder_id = App\TimePreference::where('sp_type', 'feeder')->get()->pluck('id');
        // $data['sp_feeder']['label']['time'] = App\TimePreference::where('sp_type', 'feeder')->get()->pluck('amount');
        // for ($a = 0; $a < count($cost_preference_feeder_id); $a++) {
        //     $cost_id = $cost_preference_feeder_id[$a];
        //     $cost_name = $data['sp_feeder']['label']['cost'][$a];
        //     for ($i = 0; $i < count($time_preference_feeder_id); $i++) {
        //         $data['sp_feeder']['data'][$cost_name][$i] = App\SpFeederReguler::where('cost_preference_id', $cost_id)
        //             ->where('time_preference_id', $time_preference_feeder_id[$i])
        //             ->where('respond', 1)
        //             ->count();
        //     }
        // }

        $cost_preference_feeder_premium_id = App\CostPreference::where('sp_type', 'feeder_premium')->get()->pluck('id');
        $data['sp_feeder_premium']['label']['cost'] = App\CostPreference::where('sp_type', 'feeder_premium')->get()->pluck('amount');
        for ($a = 0; $a < count($cost_preference_feeder_premium_id); $a++) {
            $cost_name = $data['sp_feeder_premium']['label']['cost'][$a];
            $data['sp_feeder_premium']['data_set'][$a]['label'] = $cost_name;
            $data['sp_feeder_premium']['data_set'][$a]['chartData'] = App\SpFeederPremium::where('cost_preference_id', $cost_preference_feeder_premium_id[$a])
                    ->where('respond', 1)
                    ->count();
        }
        // for ($a = 0; $a < count($cost_preference_feeder_premium_id); $a++) {

        //         $data['sp_feeder_premium']['data'][$a] = App\SpFeederPremium::where('cost_preference_id', $cost_preference_feeder_premium_id[$a])
        //             ->where('respond', 1)
        //             ->count();
        // }
        $cost_preference_park_ride_car_id = App\CostPreference::where('sp_type', 'park_ride_car')->get()->pluck('id');
        $data['sp_park_ride_car']['label']['cost'] = App\CostPreference::where('sp_type', 'park_ride_car')->get()->pluck('amount');
        for ($a = 0; $a < count($cost_preference_park_ride_car_id); $a++) {

            $cost_name = $data['sp_park_ride_car']['label']['cost'][$a];
            $data['sp_park_ride_car']['data_set'][$a]['label'] = $cost_name;
            $data['sp_park_ride_car']['data_set'][$a]['chartData'] = App\SpParkRidePrimaryCar::where('cost_preference_id', $cost_preference_park_ride_car_id[$a])
                    ->where('respond', 1)
                    ->count();
        }
        // for ($a = 0; $a < count($cost_preference_park_ride_car_id); $a++) {

        //         $data['sp_park_ride_car']['data'][$a] = App\SpParkRidePrimaryCar::where('cost_preference_id', $a)
        //             ->where('respond', 1)
        //             ->count();
        // }
        $cost_preference_park_ride_motor_id = App\CostPreference::where('sp_type', 'park_ride_motor')->get()->pluck('id');
        $data['sp_park_ride_motor']['label']['cost'] = App\CostPreference::where('sp_type', 'park_ride_motor')->get()->pluck('amount');
        for ($a = 0; $a < count($cost_preference_park_ride_motor_id); $a++) {
            $cost_name = $data['sp_park_ride_motor']['label']['cost'][$a];
            $data['sp_park_ride_motor']['data_set'][$a]['label'] = $cost_name;
            $data['sp_park_ride_motor']['data_set'][$a]['chartData'] = App\SpParkRidePrimaryMotor::where('cost_preference_id', $cost_preference_park_ride_motor_id[$a])
                    ->where('respond', 1)
                    ->count();
        }

        // for ($a = 0; $a < 24; $a++) {
        //     $start = $a;
        //     $end = $a + 1;
        //     $data['total_daily']['label'][] = "{$start}:00 - {$end}:00";
        //     $data['total_daily']['additional_data'][] = App\Respondent::where('step_id', '=', 5)
        //         ->whereTime('updated_at', '>=', Carbon::parse("{$start}:00"))
        //         ->whereTime('updated_at', '<=', Carbon::parse("{$start}:59:59"))
        //         ->count();
        //     $data['total_daily']['survey_preference'][] = App\Respondent::where('step_id', '=', 4)
        //         ->whereTime('updated_at', '>=', Carbon::parse("{$start}:00"))
        //         ->whereTime('updated_at', '<=', Carbon::parse("{$start}:59:59"))
        //         ->count();
        //     $data['total_daily']['travel_data'][] = App\Respondent::where('step_id', '=', 3)
        //         ->whereTime('updated_at', '>=', Carbon::parse("{$start}:00"))
        //         ->whereTime('updated_at', '<=', Carbon::parse("{$start}:59:59"))
        //         ->count();
        //     $data['total_daily']['social_data'][] = App\Respondent::where('step_id', '=', 2)
        //         ->whereTime('updated_at', '>=', Carbon::parse("{$start}:00"))
        //         ->whereTime('updated_at', '<=', Carbon::parse("{$start}:59:59"))
        //         ->count();
        // }
        // for ($a = 0; $a < 24; $a++) {
        //     $start = $a;
        //     $end = $a + 1;
        //     $data['today']['label'][] = "{$start}:00 - {$end}:00";
        //     $data['today']['additional_data'][] = App\Respondent::where('step_id', '=', 5)
        //         ->whereBetween('updated_at', [Carbon::parse("{$start}:00"), Carbon::parse("{$end}:00")])
        //         ->count();
        //     $data['today']['survey_preference'][] = App\Respondent::where('step_id', '=', 4)
        //         ->whereBetween('updated_at', [Carbon::parse("{$start}:00"), Carbon::parse("{$end}:00")])
        //         ->count();
        //     $data['today']['travel_data'][] = App\Respondent::where('step_id', '=', 3)
        //         ->whereBetween('updated_at', [Carbon::parse("{$start}:00"), Carbon::parse("{$end}:00")])
        //         ->count();
        //     $data['today']['social_data'][] = App\Respondent::where('step_id', '=', 2)
        //         ->whereBetween('updated_at', [Carbon::parse("{$start}:00"), Carbon::parse("{$end}:00")])
        //         ->count();
        // }
        // for ($a = 0; $a < 24; $a++) {
        //     $date = Carbon::createFromTimestamp(Carbon::today()->subDays(1)->timestamp)->toDateString();
        //     $start = $a;
        //     $end = $a + 1;
        //     $data['yesterday']['label'][] = "{$start}:00 - {$end}:00";
        //     $data['yesterday']['additional_data'][] = App\Respondent::where('step_id', '=', 5)
        //         ->whereBetween('updated_at', [Carbon::parse($date . "{$start}:00"), Carbon::parse($date . "{$end}:00")])
        //         ->count();
        //     $data['yesterday']['survey_preference'][] = App\Respondent::where('step_id', '=', 4)
        //         ->whereBetween('updated_at', [Carbon::parse($date . "{$start}:00"), Carbon::parse($date . "{$end}:00")])
        //         ->count();
        //     $data['yesterday']['travel_data'][] = App\Respondent::where('step_id', '=', 3)
        //         ->whereBetween('updated_at', [Carbon::parse($date . "{$start}:00"), Carbon::parse($date . "{$end}:00")])
        //         ->count();
        //     $data['yesterday']['social_data'][] = App\Respondent::where('step_id', '=', 2)
        //         ->whereBetween('updated_at', [Carbon::parse($date . "{$start}:00"), Carbon::parse($date . "{$end}:00")])
        //         ->count();
        // }
        // $data['chart']['respondent_increment'] = collect($respondent_increment)->reverse()->all();
        // $data['chart']['respondent_cummulative'] =collect($respondent_cummulative)->reverse()->all();
        // $data['chart']['date'] = collect($date_data)->reverse()->all();
        $data['stats_respondent']['target'] = 4000;
        $data['stats_respondent']['total'] = App\Respondent::count();
        $data['stats_respondent']['valid'] = App\Respondent::where('step_id', '>', 3)->count();
        $data['stats_respondent']['remaining'] = $data['stats_respondent']['target'] - $data['stats_respondent']['valid'];
        $data['gender'] = App\Gender::withCount([
            'respondents' => function ($query) {
                // $query->where('step_id', '>', 2);
            },
        ])->get();
        $data['age'] = App\Age::withCount([
            'respondents' => function ($query) {
                // $query->where('step_id', '>', 2);
            },
        ])->get();
        $data['salary'] = App\Income::withCount([
            'respondents' => function ($query) {
                // $query->where('step_id', '>', 2);
            },
        ])->get();
        $data['expenses'] = App\Expense::withCount([
            'respondents' => function ($query) {
                // $query->where('step_id', '>', 2);
            },
        ])->get();
        $data['travel_expense'] = App\TravelExpense::withCount([
            'respondents' => function ($query) {
                // $query->where('step_id', '>', 2);
            },
        ])->get();
        $data['education'] = App\Education::withCount([
            'respondents' => function ($query) {
                // $query->where('step_id', '>', 2);
            },
        ])->get();
        $data['job'] = App\Job::withCount([
            'respondents' => function ($query) {
                // $query->where('step_id', '>', 2);
            },
        ])->get();
        $data['vehicle'] = App\Vehicle::withCount([
            'respondents' => function ($query) {
                // $query->where('step_id', '>', 2);
            },
        ])->get();
        $data['parking_type'] = App\ParkingType::withCount([
            'respondents' => function ($query) {
                // $query->where('step_id', '>', 2);
            },
        ])->get();
        // $data['parking_guarantor'] = App\ParkingGuarantor::withCount([
        //     'respondents' => function ($query) {
        //         // $query->where('step_id', '>', 2);
        //     }
        // ])->get();
        // $data['travel_guarantor'] = App\TravelGuarantor::withCount([
        //     'respondents' => function ($query) {
        //         // $query->where('step_id', '>', 2);
        //     }
        // ])->get();
        $heat_map = App\Respondent::whereNotNull('origin_lat')->whereNotNull('origin_lng')->select('origin_lat', 'origin_lng')->get();
        $data['heatmap']['origin'] = collect($heat_map)->map(function ($key) {
            $data['lat'] = $key['origin_lat'];
            $data['lng'] = $key['origin_lng'];
            return $data;
        });
        $heat_map_destination = App\Respondent::whereNotNull('destination_lat')->whereNotNull('destination_lng')->select('destination_lat', 'destination_lng')->get();
        $data['heatmap']['destination'] = collect($heat_map_destination)->map(function ($key) {
            $data['lat'] = $key['destination_lat'];
            $data['lng'] = $key['destination_lng'];
            return $data;
        });
        $heat_map_origin_mrt = App\StationRespondent::where('point', 'origin')->with('station')->get();
        $data['heatmap_mrt']['origin'] = collect($heat_map_origin_mrt)->map(function ($key) {

            $data['lat'] = $key['station']['lat'];
            $data['lng'] = $key['station']['lng'];
            return $data;

        });
        $heat_map_destination_mrt = App\StationRespondent::where('point', 'destination')->with('station')->get();
        $data['heatmap_mrt']['destination'] = collect($heat_map_origin_mrt)->map(function ($key) {

            $data['lat'] = $key['station']['lat'];
            $data['lng'] = $key['station']['lng'];
            return $data;

        });
        $heat_map_origin_feeder = App\FeederRespondent::where('point', 'origin')->with('station_feeder')->get();
        $data['heatmap_feeder']['origin'] = collect($heat_map_origin_feeder)->map(function ($key) {

            $data['lat'] = $key['station_feeder']['lat'];
            $data['lng'] = $key['station_feeder']['lng'];
            return $data;

        });
        $heat_map_destination_feeder = App\FeederRespondent::where('point', 'destination')->with('station_feeder')->get();
        $data['heatmap_feeder']['destination'] = collect($heat_map_origin_feeder)->map(function ($key) {

            $data['lat'] = $key['station_feeder']['lat'];
            $data['lng'] = $key['station_feeder']['lng'];
            return $data;

        });
        $data['sp_pedestrian']['is_using'] = App\SpPedestrianChoice::where('question_id', 1)->withCount('sp_pedestrian')->get();
        $data['sp_pedestrian']['will_using'] = App\SpPedestrianChoice::where('question_id', 4)->withCount('sp_pedestrian')->orderBy('id','DESC')->get();
        $data['sp_cycle']['is_using'] = App\SpCycleChoice::where('question_id', 1)->withCount('sp_cycle')->get();
        $data['sp_cycle']['will_using'] = App\SpCycleChoice::where('question_id', 4)->withCount('sp_cycle')->orderBy('id','DESC')->get();
        $data['park_ride_count'] = App\ParkRidePoint::select(['id', 'description'])->withCount('park_ride_point_respondents')->get();
        $data['sp_count'] = App\SurveyPreference::where('description', '!=', 'Park Ride Common')->withCount('survey_preference_respondents')->get();
        // $data['sp_count'] = App\SurveyPreferenceRespondent::select('survey_preference_id', DB::raw('count(survey_preference_id) as total'))
        // ->groupBy('survey_preference_id')->orderBy('survey_preference_id', 'DESC')->with('survey_preference')
        // ->get();
        $data['transportation_mode'] = App\TravelDetail::select('transportation_mode_id', DB::raw('count(transportation_mode_id) as total'))
            ->groupBy('transportation_mode_id')->orderBy('total', 'DESC')->with('transportation_mode')
            ->get();
        $data['mrt_cost'] = App\Respondent::select('mrt_cost', DB::raw('count(mrt_cost) as total'))
            ->groupBy('mrt_cost')->orderBy('total', 'DESC')
            ->take(10)
            ->get();
        $data['purpose'] = App\TravelPurpose::withCount('respondents')->get();
        // $data['sp']['sum_total'] = $data['sp']['total'][0] + $data['sp']['total'][1] + $data['sp']['total'][2];
        return $data;

    }
}
