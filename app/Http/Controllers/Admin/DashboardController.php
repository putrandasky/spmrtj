<?php

namespace App\Http\Controllers\Admin;

use App;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function getMultiDataChartWithRespond($model, $first_data_label_name, $first_data_label, $first_data_key, $first_data_id, $second_data_label_name, $second_data_label, $second_data_key, $second_data_id)
    {
        $data['label'][$first_data_label_name] = $first_data_label;
        $data['label'][$second_data_label_name] = $second_data_label;
        for ($a = 0; $a < count($second_data_id); $a++) {
            $data['data_set'][$a]['label'] = $data['label'][$second_data_label_name][$a];
            for ($i = 0; $i < count($first_data_id); $i++) {
                $data['data_set'][$a]['chartData'][$i] = $model->where($second_data_key, $second_data_id[$a])
                    ->where($first_data_key, $first_data_id[$i])
                    ->where('respond', 1)
                    ->count();
            }
        }
        return $data;
    }
    public function getMultiDataChart($model, $first_data_label_name, $first_data_label, $first_data_key, $first_data_id, $second_data_label_name, $second_data_label, $second_data_key, $second_data_id)
    {
        $data['label'][$first_data_label_name] = $first_data_label;
        $data['label'][$second_data_label_name] = $second_data_label;
        for ($a = 0; $a < count($second_data_id); $a++) {
            $data['data_set'][$a]['label'] = $data['label'][$second_data_label_name][$a];
            for ($i = 0; $i < count($first_data_id); $i++) {
                $data['data_set'][$a]['chartData'][$i] = $model->where($second_data_key, $second_data_id[$a])
                    ->where($first_data_key, $first_data_id[$i])
                    ->count();
            }
        }
        return $data;
    }
    public function getSingleDataChart($model, $first_data_label_name, $first_data_label, $first_data_key, $first_data_id)
    {
        $data['label'][$first_data_label_name] = $first_data_label;
        for ($a = 0; $a < count($first_data_id); $a++) {
            $data['data_set'][$a]['label'] = $data['label'][$first_data_label_name][$a];
            $data['data_set'][$a]['chartData'] = $model->where($first_data_key, $first_data_id[$a])
                ->count();
        }
        return $data;

    }
    public function getSingleDataChartWithRespond($model, $first_data_label_name, $first_data_label, $first_data_key, $first_data_id)
    {
        $data['label'][$first_data_label_name] = $first_data_label;
        for ($a = 0; $a < count($first_data_id); $a++) {
            $data['data_set'][$a]['label'] = $data['label'][$first_data_label_name][$a];
            $data['data_set'][$a]['chartData'] = $model->where($first_data_key, $first_data_id[$a])
                ->where('respond', 1)
                ->count();
        }
        return $data;

    }

    public function getSingleDataChartByMode($model)
    {

        $data['label']['mode'] = array("Mobil", "Motor", "Umum", "Campuran");
        for ($i = 0; $i < count($data['label']['mode']); $i++) {
            $current_model = $model;
            $data['data_set'][$i]['label'] = $data['label']['mode'][$i];
            if ($i <= 1) {
                $selected_mode = $current_model->where('travel_model', 0)
                    ->whereHas('travel_details', function ($query) use ($i) {
                        $query->whereBetween('transportation_mode_id', $i == 0 ? [5, 6] : [3, 4]);
                    })->get();
            }
            if ($i == 2) {
                $selected_mode = $current_model->where('travel_model', 1)->get();
            }
            if ($i == 3) {
                $selected_mode = $current_model->where('travel_model', 2)->get();
            }
            $data['data_set'][$i]['chartData'] = $selected_mode->count();
        }
        return $data;
    }

    public function index()
    {
        $data['respondent_by_travel_model']['label']['mode'] = array("Mobil", "Motor", "Umum", "Campuran");
        for ($i = 0; $i < count($data['respondent_by_travel_model']['label']['mode']); $i++) {
            $current_model = App\Respondent::where('step_id', '>', 3);
            $data['respondent_by_travel_model']['data_set'][$i]['label'] = $data['respondent_by_travel_model']['label']['mode'][$i];
            if ($i <= 1) {
                $selected_mode = $current_model->where('travel_model', 0)
                    ->whereHas('travel_details', function ($query) use ($i) {
                        $query->whereBetween('transportation_mode_id', $i == 0 ? [5, 6] : [3, 4]);
                    })->get();
            }
            if ($i == 2) {
                $selected_mode = $current_model->where('travel_model', 1)->get();
            }
            if ($i == 3) {
                $selected_mode = $current_model->where('travel_model', 2)->get();
            }
            $data['respondent_by_travel_model']['data_set'][$i]['chartData'] = $selected_mode->count();
        }
        $data['travel_guarantor']['label']['guarantor'] = App\TravelGuarantor::get()->pluck('description');
        $travel_guarantor_id = App\TravelGuarantor::get()->pluck('id');
        $data['travel_guarantor']['label']['mode'] = array("Mobil", "Motor", "Umum", "Campuran");
        for ($i = 0; $i < count($data['travel_guarantor']['label']['guarantor']); $i++) {
            $data['travel_guarantor']['data_set'][$i]['label'] = $data['travel_guarantor']['label']['guarantor'][$i];
            for ($a = 0; $a < count($data['travel_guarantor']['label']['mode']); $a++) {

            if ($a <= 1) {
                $selected_mode = App\Respondent::where('step_id', '>', 3)->where('travel_model', 0)
                    ->whereHas('travel_details', function ($query) use ($a) {
                        $query->whereBetween('transportation_mode_id', $a == 0 ? [5, 6] : [3, 4]);
                    })->get();
            }
            if ($a == 2) {
                $selected_mode = App\Respondent::where('step_id', '>', 3)->where('travel_model', 1)->get();
            }
            if ($a == 3) {
                $selected_mode = App\Respondent::where('step_id', '>', 3)->where('travel_model', 2)->get();
            }
                $data['travel_guarantor']['data_set'][$i]['chartData'][$a] = $selected_mode
                    ->where('travel_guarantor_id', $travel_guarantor_id[$i])
                    ->count();
            }
        }
        $data['parking_guarantor']['label']['guarantor'] = App\ParkingGuarantor::get()->pluck('description');
        $parking_guarantor_id = App\ParkingGuarantor::get()->pluck('id');
        $data['parking_guarantor']['label']['mode'] = array("Mobil", "Motor");
        for ($i = 0; $i < count($data['parking_guarantor']['label']['mode']); $i++) {
            $data['parking_guarantor']['data_set'][$i]['label'] = $data['parking_guarantor']['label']['mode'][$i];
            $selected_mode = App\Respondent::where('step_id', '>', 3)->where('travel_model', 0)
                ->whereHas('travel_details', function ($query) use ($i) {
                    $query->whereBetween('transportation_mode_id', $i == 0 ? [5, 6] : [3, 4]);
                })->get();
            for ($a = 0; $a < count($data['parking_guarantor']['label']['guarantor']); $a++) {
                $data['parking_guarantor']['data_set'][$i]['chartData'][$a] = $selected_mode
                    ->where('parking_guarantor_id', $parking_guarantor_id[$a])
                    ->count();
            }
        }
        $data['is_pay_park']['label']['respond'] = array("Ya", "Tidak");
        for ($i = 0; $i < 2; $i++) {
            $data['is_pay_park']['data_set'][$i]['label'] = $i == 0 ? "Mobil" : "Motor";
            $selected_mode = App\Respondent::where('step_id', '>', 3)->where('travel_model', 0)
                ->whereHas('travel_details', function ($query) use ($i) {
                    $query->whereBetween('transportation_mode_id', $i == 0 ? [5, 6] : [3, 4]);
                })->get();
            $data['is_pay_park']['data_set'][$i]['chartData'][0] = $selected_mode
                ->whereNotNull('parking_guarantor_id')
                ->whereNotNull('parking_cost')
                ->count();
            $data['is_pay_park']['data_set'][$i]['chartData'][1] = $selected_mode->count();
        }
        $wtp_respondent = App\Respondent::select('mrt_cost', DB::raw('count(mrt_cost) as total'))
            ->groupBy('mrt_cost')->orderBy('total', 'DESC')
            ->take(10)->get()
            ->pluck('mrt_cost');
        $wtp_respondent_sorted = array_values(Arr::sort($wtp_respondent));
        $data['wtp_by_mode']['label']['cost'] = $wtp_respondent_sorted;
        $data['wtp_by_mode']['label']['mode'] = array("Mobil", "Motor", "Umum", "Campuran");
        for ($i = 0; $i < count($data['wtp_by_mode']['label']['cost']); $i++) {
            $data['wtp_by_mode']['data_set'][$i]['label'] = $data['wtp_by_mode']['label']['cost'][$i];
            for ($a = 0; $a < count($data['wtp_by_mode']['label']['mode']); $a++) {

            if ($a <= 1) {
                $selected_mode = App\Respondent::where('step_id', '>', 3)->where('travel_model', 0)
                    ->whereHas('travel_details', function ($query) use ($a) {
                        $query->whereBetween('transportation_mode_id', $a == 0 ? [5, 6] : [3, 4]);
                    })->get();
            }
            if ($a == 2) {
                $selected_mode = App\Respondent::where('step_id', '>', 3)->where('travel_model', 1)->get();
            }
            if ($a == 3) {
                $selected_mode = App\Respondent::where('step_id', '>', 3)->where('travel_model', 2)->get();
            }

                $data['wtp_by_mode']['data_set'][$i]['chartData'][$a] = $selected_mode
                    ->where('mrt_cost', $wtp_respondent_sorted[$i])
                    ->count();
            }
        }

        $data['wtp'] = $this->getSingleDataChart(
          App\Respondent::get(),
          'cost',
          $wtp_respondent_sorted,
          'mrt_cost',
          $wtp_respondent_sorted
      );

        $data['wtp_by_income'] = $this->getMultiDataChart(
            App\Respondent::get(),
            'income',
            App\Income::get()->pluck('description'),
            'income_id',
            App\Income::get()->pluck('id'),
            'cost',
            $wtp_respondent_sorted,
            'mrt_cost',
            $wtp_respondent_sorted
        );
        $data['wtp_by_duration']['label']['cost'] = $wtp_respondent_sorted;
        for ($i = 0; $i < 7; $i++) {
            $init_minute = ($i * 30);
            $next_minute = ($i + 1) * 30;
            if ($i < 6) {
                $data['wtp_by_duration']['label']['duration'][$i] = "{$init_minute} min - {$next_minute} min ";
            }
            if ($i >= 6) {
                $data['wtp_by_duration']['label']['duration'][$i] = " > {$init_minute} min ";
            }
        }
        for ($a = 0; $a < count($data['wtp_by_duration']['label']['cost']); $a++) {
            $data['wtp_by_duration']['data_set'][$a]['label'] = $data['wtp_by_duration']['label']['cost'][$a];
            for ($i = 0; $i < count($data['wtp_by_duration']['label']['duration']); $i++) {
                if ($i < (count($data['wtp_by_duration']['label']['duration'])-1 )) {
                    $data['wtp_by_duration']['data_set'][$a]['chartData'][$i] = App\Respondent::where('step_id', '>', 3)
                    ->where('google_duration','>=',($i * 30 * 60))
                    ->where('google_duration','<',($i + 1) * 30 * 60)
                        ->where('mrt_cost', $data['wtp_by_duration']['label']['cost'][$a])
                        ->count();
                }
                if ($i >= (count($data['wtp_by_duration']['label']['duration'])-1 )) {
                    $data['wtp_by_duration']['data_set'][$a]['chartData'][$i] = App\Respondent::where('step_id', '>', 3)->where('google_duration', '>=', ($i * 30 * 60))
                        ->where('mrt_cost', $data['wtp_by_duration']['label']['cost'][$a])
                        ->count();
                }
            }
        }

        $data['wtp_by_distance']['label']['cost'] = $wtp_respondent_sorted;
        for ($i = 0; $i < 7; $i++) {
            $init_distance = ($i * 4);
            $next_distance = ($i + 1) * 4;
            if ($i < 6) {
                $data['wtp_by_distance']['label']['distance'][$i] = "{$init_distance} km - {$next_distance} km ";
            }
            if ($i >= 6) {
                $data['wtp_by_distance']['label']['distance'][$i] = " > {$init_distance} km ";
            }
        }
        for ($a = 0; $a < count($data['wtp_by_distance']['label']['cost']); $a++) {
            $data['wtp_by_distance']['data_set'][$a]['label'] = $data['wtp_by_distance']['label']['cost'][$a];
            for ($i = 0; $i < count($data['wtp_by_distance']['label']['distance']); $i++) {
                if ($i < (count($data['wtp_by_distance']['label']['distance']) - 1)) {
                    $data['wtp_by_distance']['data_set'][$a]['chartData'][$i] = App\Respondent::whereBetween('google_distance', [($i * 4 * 1000), ($i + 1) * 4 * 1000])
                        ->where('mrt_cost', $data['wtp_by_distance']['label']['cost'][$a])
                        ->count();
                }
                if ($i >= (count($data['wtp_by_distance']['label']['distance']) - 1)) {
                    $data['wtp_by_distance']['data_set'][$a]['chartData'][$i] = App\Respondent::where('google_distance', '>=', ($i * 4 * 1000))
                        ->where('mrt_cost', $data['wtp_by_distance']['label']['cost'][$a])
                        ->count();
                }
            }
        }

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

        $data['sp_car'] = $this->getMultiDataChartWithRespond(
            App\SpCarParking::get(),
            'time',
            App\TimePreference::where('sp_type', 'park_car')->get()->pluck('amount'),
            'time_preference_id',
            App\TimePreference::where('sp_type', 'park_car')->get()->pluck('id'),
            'cost',
            App\CostPreference::where('sp_type', 'park_car')->get()->pluck('amount'),
            'cost_preference_id',
            App\CostPreference::where('sp_type', 'park_car')->get()->pluck('id')
        );

        $data['sp_motor'] = $this->getMultiDataChartWithRespond(
            App\SpMotorParking::get(),
            'time',
            App\TimePreference::where('sp_type', 'park_motor')->get()->pluck('amount'),
            'time_preference_id',
            App\TimePreference::where('sp_type', 'park_motor')->get()->pluck('id'),
            'cost',
            App\CostPreference::where('sp_type', 'park_motor')->get()->pluck('amount'),
            'cost_preference_id',
            App\CostPreference::where('sp_type', 'park_motor')->get()->pluck('id')
        );

        $data['sp_feeder'] = $this->getMultiDataChartWithRespond(
            App\SpFeederReguler::get(),
            'time',
            App\TimePreference::where('sp_type', 'feeder')->get()->pluck('amount'),
            'time_preference_id',
            App\TimePreference::where('sp_type', 'feeder')->get()->pluck('id'),
            'cost',
            App\CostPreference::where('sp_type', 'feeder')->get()->pluck('amount'),
            'cost_preference_id',
            App\CostPreference::where('sp_type', 'feeder')->get()->pluck('id')
        );
        $data['sp_feeder_car'] = $this->getMultiDataChartWithRespond(
            App\SpFeederReguler::join('respondents', 'sp_feeder_regulers.respondent_id', '=', 'respondents.id')
            ->where('travel_model',0)
            ->whereHas('respondent.travel_details', function ($query) {
                $query->whereBetween('transportation_mode_id', [5, 6]);
            })->get(),
            'time',
            App\TimePreference::where('sp_type', 'feeder')->get()->pluck('amount'),
            'time_preference_id',
            App\TimePreference::where('sp_type', 'feeder')->get()->pluck('id'),
            'cost',
            App\CostPreference::where('sp_type', 'feeder')->get()->pluck('amount'),
            'cost_preference_id',
            App\CostPreference::where('sp_type', 'feeder')->get()->pluck('id')
        );
        $data['sp_feeder_motor'] = $this->getMultiDataChartWithRespond(
          App\SpFeederReguler::join('respondents', 'sp_feeder_regulers.respondent_id', '=', 'respondents.id')
          ->where('travel_model',0)
          ->whereHas('respondent.travel_details', function ($query) {
              $query->whereBetween('transportation_mode_id', [3, 4]);
          })->get(),
            'time',
            App\TimePreference::where('sp_type', 'feeder')->get()->pluck('amount'),
            'time_preference_id',
            App\TimePreference::where('sp_type', 'feeder')->get()->pluck('id'),
            'cost',
            App\CostPreference::where('sp_type', 'feeder')->get()->pluck('amount'),
            'cost_preference_id',
            App\CostPreference::where('sp_type', 'feeder')->get()->pluck('id')
        );
        $data['sp_feeder_public'] = $this->getMultiDataChartWithRespond(
          App\SpFeederReguler::join('respondents', 'sp_feeder_regulers.respondent_id', '=', 'respondents.id')
          ->where('travel_model',1)->get(),
            'time',
            App\TimePreference::where('sp_type', 'feeder')->get()->pluck('amount'),
            'time_preference_id',
            App\TimePreference::where('sp_type', 'feeder')->get()->pluck('id'),
            'cost',
            App\CostPreference::where('sp_type', 'feeder')->get()->pluck('amount'),
            'cost_preference_id',
            App\CostPreference::where('sp_type', 'feeder')->get()->pluck('id')
        );
        $data['sp_feeder_mix'] = $this->getMultiDataChartWithRespond(
          App\SpFeederReguler::join('respondents', 'sp_feeder_regulers.respondent_id', '=', 'respondents.id')
          ->where('travel_model',2)->get(),
            'time',
            App\TimePreference::where('sp_type', 'feeder')->get()->pluck('amount'),
            'time_preference_id',
            App\TimePreference::where('sp_type', 'feeder')->get()->pluck('id'),
            'cost',
            App\CostPreference::where('sp_type', 'feeder')->get()->pluck('amount'),
            'cost_preference_id',
            App\CostPreference::where('sp_type', 'feeder')->get()->pluck('id')
        );


        $data['sp_feeder_premium'] = $this->getSingleDataChartWithRespond(
            App\SpFeederPremium::get(),
            'cost',
            App\CostPreference::where('sp_type', 'feeder_premium')->get()->pluck('amount'),
            'cost_preference_id',
            App\CostPreference::where('sp_type', 'feeder_premium')->get()->pluck('id')
        );
        $data['sp_feeder_park'] = $this->getSingleDataChartWithRespond(
            App\SpFeederPark::get(),
            'cost',
            App\CostPreference::where('sp_type', 'feeder_park')->get()->pluck('amount'),
            'cost_preference_id',
            App\CostPreference::where('sp_type', 'feeder_park')->get()->pluck('id')
        );

        $data['sp_feeder_park_car'] = $this->getSingleDataChartWithRespond(
            App\SpFeederPark::join('respondents', 'sp_feeder_parks.respondent_id', '=', 'respondents.id')
            ->where('travel_model',0)
            ->whereHas('respondent.travel_details', function ($query) {
                $query->whereBetween('transportation_mode_id', [5, 6]);
            })->get(),
            'cost',
            App\CostPreference::where('sp_type', 'feeder_park')->get()->pluck('amount'),
            'cost_preference_id',
            App\CostPreference::where('sp_type', 'feeder_park')->get()->pluck('id')
        );
        $data['sp_feeder_park_motor'] = $this->getSingleDataChartWithRespond(
          App\SpFeederPark::join('respondents', 'sp_feeder_parks.respondent_id', '=', 'respondents.id')
          ->where('travel_model',0)
          ->whereHas('respondent.travel_details', function ($query) {
              $query->whereBetween('transportation_mode_id', [3, 4]);
          })->get(),
            'cost',
            App\CostPreference::where('sp_type', 'feeder_park')->get()->pluck('amount'),
            'cost_preference_id',
            App\CostPreference::where('sp_type', 'feeder_park')->get()->pluck('id')
        );
        $data['sp_park_ride_car_with_mrt'] = $this->getSingleDataChartWithRespond(
            App\SpParkRidePrimaryCar::whereHas('respondent', function ($query) {
                $query->where('step_id', '>', 3);
            })->whereHas('respondent.travel_details', function ($query) {
                $query->where('transportation_mode_id', 17);
            })->get(),
            'cost',
            App\CostPreference::where('sp_type', 'park_ride_car')->get()->pluck('amount'),
            'cost_preference_id',
            App\CostPreference::where('sp_type', 'park_ride_car')->get()->pluck('id')
        );
        $data['sp_park_ride_car_without_mrt'] = $this->getSingleDataChartWithRespond(
            App\SpParkRidePrimaryCar::whereHas('respondent', function ($query) {
                $query->where('step_id', '>', 3);
            })->whereDoesntHave('respondent.travel_details', function ($query) {
                $query->where('transportation_mode_id', 17);
            })->get(),
            'cost',
            App\CostPreference::where('sp_type', 'park_ride_car')->get()->pluck('amount'),
            'cost_preference_id',
            App\CostPreference::where('sp_type', 'park_ride_car')->get()->pluck('id')
        );
        $data['sp_park_ride_car_hypo'] = $this->getSingleDataChartWithRespond(
            App\SpParkRideHypoCar::whereHas('respondent', function ($query) {
                $query->where('step_id', '>', 3);
            })->get(),
            'distance',
            array("0,5 km", "1 km", "2 km", "3 km", "5 km", "8 km", "10 km"),
            'question_id',
            array(1, 2, 3, 4, 5, 6, 7)
        );

        $data['sp_park_ride_motor_with_mrt'] = $this->getSingleDataChartWithRespond(
            App\SpParkRidePrimaryMotor::whereHas('respondent', function ($query) {
                $query->where('step_id', '>', 3);
            })->whereHas('respondent.travel_details', function ($query) {
                $query->where('transportation_mode_id', 17);
            })->get(),
            'cost',
            App\CostPreference::where('sp_type', 'park_ride_motor')->get()->pluck('amount'),
            'cost_preference_id',
            App\CostPreference::where('sp_type', 'park_ride_motor')->get()->pluck('id')
        );
        $data['sp_park_ride_motor_without_mrt'] = $this->getSingleDataChartWithRespond(
            App\SpParkRidePrimaryMotor::whereHas('respondent', function ($query) {
                $query->where('step_id', '>', 3);
            })->whereDoesntHave('respondent.travel_details', function ($query) {
                $query->where('transportation_mode_id', 17);
            })->get(),
            'cost',
            App\CostPreference::where('sp_type', 'park_ride_motor')->get()->pluck('amount'),
            'cost_preference_id',
            App\CostPreference::where('sp_type', 'park_ride_motor')->get()->pluck('id')
        );
        $data['sp_park_ride_motor_hypo'] = $this->getSingleDataChartWithRespond(
            App\SpParkRideHypoMotor::whereHas('respondent', function ($query) {
                $query->where('step_id', '>', 3);
            })->get(),
            'distance',
            array("0,5 km", "1 km", "2 km", "3 km", "5 km", "8 km", "10 km"),
            'question_id',
            array(1, 2, 3, 4, 5, 6, 7)
        );

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
        // $heat_map_destination_mrt = App\StationRespondent::where('point', 'destination')->with('station')->get();
        // $data['heatmap_mrt']['destination'] = collect($heat_map_origin_mrt)->map(function ($key) {

        //     $data['lat'] = $key['station']['lat'];
        //     $data['lng'] = $key['station']['lng'];
        //     return $data;

        // });
        $heat_map_origin_feeder = App\FeederRespondent::where('point', 'origin')->with('station_feeder')->get();
        $data['heatmap_feeder']['origin'] = collect($heat_map_origin_feeder)->map(function ($key) {

            $data['lat'] = $key['station_feeder']['lat'];
            $data['lng'] = $key['station_feeder']['lng'];
            return $data;

        });
        // $heat_map_destination_feeder = App\FeederRespondent::where('point', 'destination')->with('station_feeder')->get();
        // $data['heatmap_feeder']['destination'] = collect($heat_map_origin_feeder)->map(function ($key) {

        //     $data['lat'] = $key['station_feeder']['lat'];
        //     $data['lng'] = $key['station_feeder']['lng'];
        //     return $data;

        // });
        $data['sp_pedestrian']['is_using'] = App\SpPedestrianChoice::where('question_id', 1)->withCount('sp_pedestrian')->get();
        $data['sp_pedestrian']['will_using'] = App\SpPedestrianChoice::where('question_id', 4)->withCount('sp_pedestrian')->orderBy('id', 'DESC')->get();
        $data['sp_pedestrian_by_income'] = $this->getSingleDataChart(
            App\SpPedestrian::where([
                'question_id' => 1,
                'sp_pedestrian_choice_id' => 1,
            ])->
                join('respondents', 'sp_pedestrians.respondent_id', '=', 'respondents.id')
                ->get(),
            'income',
            App\Income::get()->pluck('description'),
            'income_id',
            App\Income::get()->pluck('id')
        );
        $data['sp_pedestrian_by_mode']['label']['mode'] = array("Mobil", "Motor", "Umum", "Campuran");
        for ($i = 0; $i < count($data['sp_pedestrian_by_mode']['label']['mode']); $i++) {
            $current_model = App\Respondent::join('sp_pedestrians', 'respondents.id', '=', 'sp_pedestrians.respondent_id')
                ->where([
                    'question_id' => 1,
                    'sp_pedestrian_choice_id' => 1,
                ]);
            $data['sp_pedestrian_by_mode']['data_set'][$i]['label'] = $data['sp_pedestrian_by_mode']['label']['mode'][$i];
            if ($i <= 1) {
                $selected_mode = $current_model->where('travel_model', 0)
                    ->whereHas('travel_details', function ($query) use ($i) {
                        $query->whereBetween('transportation_mode_id', $i == 0 ? [5, 6] : [3, 4]);
                    })->get();
            }
            if ($i == 2) {
                $selected_mode = $current_model->where('travel_model', 1)->get();
            }
            if ($i == 3) {
                $selected_mode = $current_model->where('travel_model', 2)->get();
            }
            $data['sp_pedestrian_by_mode']['data_set'][$i]['chartData'] = $selected_mode->count();
        }
        $data['sp_cycle']['is_using'] = App\SpCycleChoice::where('question_id', 1)->withCount('sp_cycle')->get();
        $data['sp_cycle']['will_using'] = App\SpCycleChoice::where('question_id', 4)->withCount('sp_cycle')->orderBy('id', 'DESC')->get();
        $data['sp_cycle_by_income'] = $this->getSingleDataChart(
            App\SpCycle::where([
                'question_id' => 1,
                'sp_cycle_choice_id' => 1,
            ])->
                join('respondents', 'sp_cycles.respondent_id', '=', 'respondents.id')
                ->get(),
            'income',
            App\Income::get()->pluck('description'),
            'income_id',
            App\Income::get()->pluck('id')
        );
        $data['sp_cycle_by_mode']['label']['mode'] = array("Mobil", "Motor", "Umum", "Campuran");
        for ($i = 0; $i < count($data['sp_cycle_by_mode']['label']['mode']); $i++) {
            $current_model = App\Respondent::join('sp_cycles', 'respondents.id', '=', 'sp_cycles.respondent_id')
                ->where([
                    'question_id' => 1,
                    'sp_cycle_choice_id' => 1,
                ]);
            $data['sp_cycle_by_mode']['data_set'][$i]['label'] = $data['sp_cycle_by_mode']['label']['mode'][$i];
            if ($i <= 1) {
                $selected_mode = $current_model->where('travel_model', 0)
                    ->whereHas('travel_details', function ($query) use ($i) {
                        $query->whereBetween('transportation_mode_id', $i == 0 ? [5, 6] : [3, 4]);
                    })->get();
            }
            if ($i == 2) {
                $selected_mode = $current_model->where('travel_model', 1)->get();
            }
            if ($i == 3) {
                $selected_mode = $current_model->where('travel_model', 2)->get();
            }
            $data['sp_cycle_by_mode']['data_set'][$i]['chartData'] = $selected_mode->count();
        }
        $data['park_ride_count'] = App\ParkRidePoint::select(['id', 'description'])->withCount('park_ride_point_respondents')->get();
        $data['sp_count'] = App\SurveyPreference::where('description', '!=', 'Park Ride Common')->withCount('survey_preference_respondents')->get();
        // $data['sp_count'] = App\SurveyPreferenceRespondent::select('survey_preference_id', DB::raw('count(survey_preference_id) as total'))
        // ->groupBy('survey_preference_id')->orderBy('survey_preference_id', 'DESC')->with('survey_preference')
        // ->get();
        $data['transportation_mode'] = App\TravelDetail::select('transportation_mode_id', DB::raw('count(transportation_mode_id) as total'))
            ->groupBy('transportation_mode_id')->orderBy('total', 'DESC')->with('transportation_mode')
            ->get();
        // $data['mrt_cost'] = App\Respondent::select('mrt_cost', DB::raw('count(mrt_cost) as total'))
        //     ->groupBy('mrt_cost')->orderBy('total', 'DESC')
        //     ->take(10)
        //     ->get();
        $data['purpose'] = App\TravelPurpose::withCount('respondents')->get();
        // $data['sp']['sum_total'] = $data['sp']['total'][0] + $data['sp']['total'][1] + $data['sp']['total'][2];
        return $data;

    }
}
