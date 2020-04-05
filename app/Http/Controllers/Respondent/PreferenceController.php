<?php

namespace App\Http\Controllers\Respondent;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PreferenceController extends Controller
{

    public function getParkCar()
    {
        $data['cost_preferences'] = App\CostPreference::where('sp_type', 'park_car')->get();
        $data['time_preferences'] = App\TimePreference::where('sp_type', 'park_car')->get();
        return $data;
    }
    public function storeParkCar(Request $request)
    {
        $respondent = App\Respondent::where([
            // 'id' => $request->respondent_id,
            'token' => $request->token,
        ])->first();

        for ($i = 0; $i < count($request['data']); $i++) {
            $state = new App\SpCarParking();
            $state->respondent_id = $respondent->id;
            $state->time_preference_id = $request['data'][$i]['time_id'];
            $state->cost_preference_id = $request['data'][$i]['cost_id'];
            $state->respond = $request['data'][$i]['respond'];
            $state->save();
        }

        $this->updateSurveyPreferenceRespondent($respondent->id, $request->sp_id);
        return response()->json([
            'message' => 'Berhasil menyimpan data preferensi kebijakan parkir mobil',
            'token' => $request->token,
            'status' => 'success',
        ], 200);
    }
    public function getParkMotor()
    {
        $data['cost_preferences'] = App\CostPreference::where('sp_type', 'park_motor')->get();
        $data['time_preferences'] = App\TimePreference::where('sp_type', 'park_motor')->get();
        return $data;
    }
    public function storeParkMotor(Request $request)
    {
        $respondent = App\Respondent::where([
            // 'id' => $request->respondent_id,
            'token' => $request->token,
        ])->first();

        for ($i = 0; $i < count($request['data']); $i++) {
            $state = new App\SpMotorParking();
            $state->respondent_id = $respondent->id;
            $state->time_preference_id = $request['data'][$i]['time_id'];
            $state->cost_preference_id = $request['data'][$i]['cost_id'];
            $state->respond = $request['data'][$i]['respond'];
            $state->save();
        }
        $this->updateSurveyPreferenceRespondent($respondent->id, $request->sp_id);
        return response()->json([
            'message' => 'Berhasil menyimpan data preferensi kebijakan parkir motor',
            'token' => $request->token,
            'status' => 'success',
        ], 200);
    }
    public function getFeeder()
    {
        $data['cost_preferences'] = App\CostPreference::where('sp_type', 'feeder')->get();
        $data['time_preferences'] = App\TimePreference::where('sp_type', 'feeder')->get();
        return $data;
    }
    public function getFeederPark(Request $request)
    {
        $respondent = App\Respondent::where([
            // 'id' => $request->respondent_id,
            'token' => $request->token,
        ])->first();
        $has_sp_car_park = App\Respondent::whereHas('sp_car_parkings')->where('id',$respondent->id)->first();
        $has_sp_motor_park = App\Respondent::whereHas('sp_motor_parkings')->where('id',$respondent->id)->first();

        $data['sp_feeder_reguler'] = App\SpFeederReguler::where([
            'respondent_id' => $respondent->id,
        ])
            ->orderBy('cost_preference_id')
            ->with('cost_preference', 'time_preference')
            ->first();

        $data['cost_preference'] = App\CostPreference::where('sp_type', 'feeder_park')->orderBy('id', 'desc')->get();
        if ($has_sp_car_park) {
            $data['sp_parking'] = App\SpCarParking::where([
                'respondent_id' => $respondent->id,
            ])->orderBy('cost_preference_id', 'desc')
                ->with('cost_preference', 'time_preference')
                ->first();
            return $data;
        }
        if ($has_sp_motor_park) {
            $data['sp_parking'] = App\SpMotorParking::where([
                'respondent_id' => $respondent->id,
            ])->orderBy('cost_preference_id', 'desc')
                ->with('cost_preference', 'time_preference')
                ->first();
            return $data;
        }

        // print_r($has_sp_car_park);
    }

    public function storeFeederPark(Request $request)
    {
        $respondent = App\Respondent::where([
            // 'id' => $request->respondent_id,
            'token' => $request->token,
        ])->first();

        for ($i = 0; $i < count($request['data']); $i++) {
            $state = new App\SpFeederPark();
            $state->respondent_id = $respondent->id;
            $state->cost_preference_id = $request['data'][$i]['cost_id'];
            $state->respond = $request['data'][$i]['respond'];
            $state->save();
        }
        $this->updateSurveyPreferenceRespondent($respondent->id, $request->sp_id);
        return response()->json([
            'message' => 'Berhasil menyimpan data preferensi kebijakan feeder dan parkir',
            'token' => $request->token,
            'status' => 'success',
        ], 200);
    }
    public function storeFeeder(Request $request)
    {
        $respondent = App\Respondent::where([
            // 'id' => $request->respondent_id,
            'token' => $request->token,
        ])->first();

        for ($i = 0; $i < count($request['data']); $i++) {
            $state = new App\SpFeederReguler();
            $state->respondent_id = $respondent->id;
            $state->time_preference_id = $request['data'][$i]['time_id'];
            $state->cost_preference_id = $request['data'][$i]['cost_id'];
            $state->respond = $request['data'][$i]['respond'];
            $state->save();
        }
        $respondent->is_using_feeder_reguler = $request->isUsingFeederReguler;
        $respondent->save();
        $this->updateSurveyPreferenceRespondent($respondent->id, $request->sp_id);
        return response()->json([
            'message' => 'Berhasil menyimpan data preferensi kebijakan feeder reguler',
            'token' => $request->token,
            'status' => 'success',
        ], 200);
    }
    public function getFeederPremium()
    {
        $data['cost_preferences'] = App\CostPreference::where('sp_type', 'feeder_premium')->get();
        return $data;
    }
    public function storeFeederPremium(Request $request)
    {
        $respondent = App\Respondent::where([
            // 'id' => $request->respondent_id,
            'token' => $request->token,
        ])->first();

        for ($i = 0; $i < count($request['data']); $i++) {
            $state = new App\SpFeederPremium();
            $state->respondent_id = $respondent->id;
            $state->cost_preference_id = $request['data'][$i]['cost_id'];
            $state->respond = $request['data'][$i]['respond'];
            $state->save();
        }
        $respondent->is_using_feeder_premium = $request->isUsingFeederPremium;
        $respondent->save();
        $this->updateSurveyPreferenceRespondent($respondent->id, $request->sp_id);
        return response()->json([
            'message' => 'Berhasil menyimpan data preferensi kebijakan feeder premium',
            'token' => $request->token,
            'status' => 'success',
        ], 200);
    }

    public function getParkRideCar()
    {
        $data['cost_preferences'] = App\CostPreference::where('sp_type', 'park_ride_car')->get();
        return $data;
    }
    public function storeParkRideCar(Request $request)
    {
        $respondent = App\Respondent::where([
            // 'id' => $request->respondent_id,
            'token' => $request->token,
        ])->first();
        for ($i = 0; $i < count($request['data']); $i++) {
            $state = new App\SpParkRidePrimaryCar();
            $state->respondent_id = $respondent->id;
            $state->cost_preference_id = $request['data'][$i]['cost_id'];
            $state->respond = $request['data'][$i]['respond'];
            $state->save();
        }
        $this->updateSurveyPreferenceRespondent($respondent->id, $request->sp_id);
        return response()->json([
            'message' => 'Berhasil menyimpan data preferensi kebijakan Park and Ride pengguna mobil pribadi',
            'token' => $request->token,
            'status' => 'success',
        ], 200);
    }
    public function storeParkRideMotor(Request $request)
    {
        $respondent = App\Respondent::where([
            // 'id' => $request->respondent_id,
            'token' => $request->token,
        ])->first();
        for ($i = 0; $i < count($request['data']); $i++) {
            $state = new App\SpParkRidePrimaryMotor();
            $state->respondent_id = $respondent->id;
            $state->cost_preference_id = $request['data'][$i]['cost_id'];
            $state->respond = $request['data'][$i]['respond'];
            $state->save();
        }
        $this->updateSurveyPreferenceRespondent($respondent->id, $request->sp_id);
        return response()->json([
            'message' => 'Berhasil menyimpan data preferensi kebijakan Park and Ride pengguna mobil pribadi',
            'token' => $request->token,
            'status' => 'success',
        ], 200);
    }
    public function storeParkRideHypoMotor(Request $request)
    {
        $respondent = App\Respondent::where([
            // 'id' => $request->respondent_id,
            'token' => $request->token,
        ])->first();
        for ($i = 0; $i < count($request['data']); $i++) {
            $state = new App\SpParkRideHypoMotor();
            $state->respondent_id = $respondent->id;
            $state->question_id = $request['data'][$i]['question_id'];
            $state->respond = $request['data'][$i]['respond'];
            $state->save();
        }

        $this->updateSurveyPreferenceRespondent($respondent->id, $request->sp_id);
        return response()->json([
            'message' => 'Berhasil menyimpan data preferensi kebijakan Park and Ride (Hypothetical) pengguna mobil pribadi',
            'token' => $request->token,
            'status' => 'success',
        ], 200);
    }
    public function storeParkRideHypoCar(Request $request)
    {
        $respondent = App\Respondent::where([
            // 'id' => $request->respondent_id,
            'token' => $request->token,
        ])->first();
        for ($i = 0; $i < count($request['data']); $i++) {
            $state = new App\SpParkRideHypoCar();
            $state->respondent_id = $respondent->id;
            $state->question_id = $request['data'][$i]['question_id'];
            $state->respond = $request['data'][$i]['respond'];
            $state->save();
        }
        $this->updateSurveyPreferenceRespondent($respondent->id, $request->sp_id);
        return response()->json([
            'message' => 'Berhasil menyimpan data preferensi kebijakan Park and Ride (Hypothetical) pengguna mobil pribadi',
            'token' => $request->token,
            'status' => 'success',
        ], 200);
    }
    public function storeParkRideCommon(Request $request)
    {
        $respondent = App\Respondent::where([
            // 'id' => $request->respondent_id,
            'token' => $request->token,
        ])->first();

        $park_ride_common = new App\SpParkRideCommon();
        $park_ride_common->respondent_id = $respondent->id;
        $park_ride_common->question_id = 1;
        $park_ride_common->respond = $request->location;
        $park_ride_common->save();

        $park_ride_common = new App\SpParkRideCommon();
        $park_ride_common->respondent_id = $respondent->id;
        $park_ride_common->question_id = 2;
        $park_ride_common->respond = $request->park_type;
        $park_ride_common->save();

        foreach ($request->facility as $v) {
            $park_ride_common = new App\SpParkRideCommon();
            $park_ride_common->respondent_id = $respondent->id;
            $park_ride_common->question_id = 3;
            $park_ride_common->respond = $v;
            $park_ride_common->save();
        }
        $park_ride_common = new App\SpParkRideCommon();
        $park_ride_common->respondent_id = $respondent->id;
        $park_ride_common->question_id = 4;
        $park_ride_common->respond = $request->park_duration;
        $park_ride_common->save();

        $this->updateSurveyPreferenceRespondent($respondent->id, $request->sp_id);

        return response()->json([
            'message' => 'Berhasil menyimpan data preferensi kebijakan park and ride',
            'token' => $request->token,
            'status' => 'success',
        ], 200);

    }
    public function getParkRideMotor()
    {
        $data['cost_preferences'] = App\CostPreference::where('sp_type', 'park_ride_motor')->get();
        return $data;
    }
    public function getPedestrian()
    {
        $data = App\SpPedestrianChoice::all();
        return $data;
    }
    public function storePedestrian(Request $request)
    {
        $respondent = App\Respondent::where([
            // 'id' => $request->respondent_id,
            'token' => $request->token,
        ])->first();
        $question_1 = new App\SpPedestrian();
        $question_1->respondent_id = $respondent->id;
        $question_1->question_id = 1;
        $question_1->sp_pedestrian_choice_id = $request->question_1;
        $question_1->save();

        foreach ($request->question_2 as $v) {
            $question_2 = new App\SpPedestrian();
            $question_2->respondent_id = $respondent->id;
            $question_2->question_id = 2;
            $question_2->sp_pedestrian_choice_id = $v;
            $question_2->save();
            if ($v == 9) {
                $question_2_other = new App\SpPedestrianOther();
                $question_2_other->sp_pedestrian_id = $question_2->id;
                $question_2_other->description = $request->question_2_other;
                $question_2_other->save();
                // $question_2_other = new App\SpCycleOther([
                //     'description'=>$request->question_2_other
                // ]);
                // $question_2->sp_cycle_other()->save($question_2_other);
            }
        }
        foreach ($request->question_3 as $v) {
            $question_3 = new App\SpPedestrian();
            $question_3->respondent_id = $respondent->id;
            $question_3->question_id = 3;
            $question_3->sp_pedestrian_choice_id = $v;
            $question_3->save();
        }
        $question_4 = new App\SpPedestrian();
        $question_4->respondent_id = $respondent->id;
        $question_4->question_id = 4;
        $question_4->sp_pedestrian_choice_id = $request->question_4;
        $question_4->save();

        $this->updateSurveyPreferenceRespondent($respondent->id, $request->sp_id);

        return response()->json([
            'message' => 'Berhasil menyimpan data preferensi kebijakan jalur pedestrian',
            'token' => $request->token,
            'status' => 'success',
        ], 200);
    }
    public function getCycle()
    {
        $data = App\SpCycleChoice::all();
        return $data;
    }
    public function storeCycle(Request $request)
    {
        $respondent = App\Respondent::where([
            // 'id' => $request->respondent_id,
            'token' => $request->token,
        ])->first();
        $question_1 = new App\SpCycle();
        $question_1->respondent_id = $respondent->id;
        $question_1->question_id = 1;
        $question_1->sp_cycle_choice_id = $request->question_1;
        $question_1->save();

        foreach ($request->question_2 as $v) {
            $question_2 = new App\SpCycle();
            $question_2->respondent_id = $respondent->id;
            $question_2->question_id = 2;
            $question_2->sp_cycle_choice_id = $v;
            $question_2->save();
            //mesti di cek id pilihan ganda nya kalau ada penambahan pilihan jawaban
            if ($v == 9) {
                $question_2_other = new App\SpCycleOther();
                $question_2_other->sp_cycle_id = $question_2->id;
                $question_2_other->description = $request->question_2_other;
                $question_2_other->save();
                // $question_2_other = new App\SpCycleOther([
                //     'description'=>$request->question_2_other
                // ]);
                // $question_2->sp_cycle_other()->save($question_2_other);
            }
        }
        foreach ($request->question_3 as $v) {
            $question_3 = new App\SpCycle();
            $question_3->respondent_id = $respondent->id;
            $question_3->question_id = 3;
            $question_3->sp_cycle_choice_id = $v;
            $question_3->save();
        }
        $question_4 = new App\SpCycle();
        $question_4->respondent_id = $respondent->id;
        $question_4->question_id = 4;
        $question_4->sp_cycle_choice_id = $request->question_4;
        $question_4->save();

        $this->updateSurveyPreferenceRespondent($respondent->id, $request->sp_id);

        return response()->json([
            'message' => 'Berhasil menyimpan data preferensi kebijakan jalur sepeda',
            'token' => $request->token,
            'status' => 'success',
        ], 200);
    }
    public function completedSurveyPreference(Request $request)
    {
        $respondent = App\Respondent::where([
            // 'id' => $request->respondent_id,
            'token' => $request->token,
        ])->first();
        $respondent->step_id = 4;
        $respondent->save();
        return response()->json([
            'message' => 'Berhasil menyelesaikan survey preferensi',
            'token' => $request->token,
            'status' => 'success',
        ], 200);

    }
    public function updateSurveyPreferenceRespondent($respondent_id, $sp_id)
    {

        $survei_preference_responden = App\SurveyPreferenceRespondent::where([
            'respondent_id' => $respondent_id,
            'survey_preference_id' => $sp_id,
        ])->first();
        $survei_preference_responden->status = 1;
        $survei_preference_responden->save();
    }

}
