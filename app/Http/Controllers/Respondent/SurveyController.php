<?php

namespace App\Http\Controllers\Respondent;

use App;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    public function getSocialData()
    {
        $data['gender'] = App\Gender::all();
        $data['age'] = App\Age::all();
        $data['job'] = App\Job::all();
        $data['income'] = App\Income::all();
        $data['expense'] = App\Expense::all();
        $data['vehicle'] = App\Vehicle::all();
        $data['education'] = App\Education::all();
        $data['travel_guarantor'] = App\TravelGuarantor::all();
        $data['license'] = App\License::all();
        $data['travel_expense'] = App\TravelExpense::all();
        return $data;
    }
    public function storeSocialData(Request $request)
    {
        $respondent = new App\Respondent();
        $respondent->gender_id = $request->gender;
        $respondent->age_id = $request->age;
        $respondent->education_id = $request->education;
        $respondent->job_id = $request->job;
        $respondent->income_id = $request->income;
        $respondent->expense_id = $request->expense;
        $respondent->travel_expense_id = $request->travel_expense;
        $respondent->travel_guarantor_id = $request->travel_guarantor;
        $respondent->license_id = $request->license;
        $respondent->vehicle_id = $request->vehicle;
        $respondent->token = $request->token;
        $respondent->step_id = 2;
        $respondent->save();
        return response()->json([
            'message' => 'Data sosial responden berhasil disimpan',
            'token' => $respondent->token,
        ], 200);

    }

    public function getTravelData()
    {
        $data['travel_purposes'] = App\TravelPurpose::all();
        $data['transportation_modes'] = App\TransportationMode::all();
        $data['parking_guarantors'] = App\ParkingGuarantor::all();
        $data['parking_types'] = App\ParkingType::all();
        $data['coverages']['parkir'] = App\Coverage::where('area_id', 1)->get();
        $data['coverages']['cycle'] = App\Coverage::where('area_id', 2)->get();
        $data['coverages']['pedestrian'] = App\Coverage::where('area_id', 3)->get();
        $data['coverages']['park_and_ride'] = App\Coverage::where('area_id', 4)->get();
        $data['coverages']['feeder'] = App\Coverage::where('area_id', 5)->get();
        return $data;
    }
    public function storeTravelData(Request $request)
    {
        $respondent = App\Respondent::where([
            'token' => $request->token,
        ])->first();

        if (!$respondent) {
            return response()->json(['message' => 'Responden tidak ditemukan'], 500);
        }

        $respondent->travel_purpose_id = $request->travel_purpose;
        $respondent->travel_model = $request->travel_model;
        $respondent->travel_frequency = $request->trip_frequency;
        $respondent->parking_guarantor_id = $request->parking_guarantor;
        $respondent->parking_cost = $request->parking_cost;
        $respondent->parking_type_id = $request->parking_type;
        $respondent->origin = $request->input('travel_origin.formatted_address');
        $respondent->origin_lat = $request->input('travel_origin.geometry.location.lat');
        $respondent->origin_lng = $request->input('travel_origin.geometry.location.lng');
        $respondent->destination = $request->input('travel_destination.formatted_address');
        $respondent->destination_lat = $request->input('travel_destination.geometry.location.lat');
        $respondent->destination_lng = $request->input('travel_destination.geometry.location.lng');
        $respondent->save();
        foreach ($request->area_origin as $v) {
            $area_origin = new App\AreaOrigin();
            $area_origin->respondent_id = $respondent->id;
            $area_origin->area_id = $v;
            $area_origin->save();
        }
        foreach ($request->area_destination as $v) {
            $area_destination = new App\AreaDestination();
            $area_destination->respondent_id = $respondent->id;
            $area_destination->area_id = $v;
            $area_destination->save();
        }

        foreach ($request->travel_detail as $v) {
            $travel_detail = new App\TravelDetail();
            $travel_detail->respondent_id = $respondent->id;
            $travel_detail->transportation_mode_id = $v['transportation_mode'];
            $travel_detail->waiting_duration = $v['waiting_duration'];
            $travel_detail->travel_duration = $v['travel_duration'];
            $travel_detail->travel_cost = $v['travel_cost'];
            $travel_detail->save();
        }
        $respondent->step_id = 3;
        $respondent->save();
        return response()->json([
            'message' => 'Data perjalanan responden berhasil disimpan',
            'token' => $respondent->token,
        ], 200);

    }

    public function getAdditionalData()
    {
        $data['reason_using_transportation_choices'] = App\ReasonUsingTransportationChoice::all();
        $data['mrt_improvement_choices'] = App\MrtImprovementChoice::all();
        $data['work_place_parking_system'] = App\WorkPlaceParkingSystem::all();
        $data['willingness_public_transport_trip'] = App\WillingnessPublicTransportTrip::all();
        return $data;
    }
    public function storeAdditionalData(Request $request)
    {
        // reason_using_transport: [],
        //         mrt_improvement: [],
        //         work_place_parking_system: null,
        //         willingness_public_transport_trip: null,
        //         mrt_cost: 0,
        //         is_using_mrt: null,
        //         reason_is_using_mrt: ""

        $respondent = App\Respondent::where([
            'token' => $request->token,
        ])->first();
        $respondent->work_place_parking_system_id = $request->work_place_parking_system;
        $respondent->mrt_cost = $request->mrt_cost;
        $respondent->reason_is_using_mrt = $request->reason_is_using_mrt;
        $respondent->willingness_public_transport_trip_id = $request->willingness_public_transport_tri;
        for ($i = 0; $i < count($request['reason_using_transport']); $i++) {
            $reason_using_transport = new App\ReasonUsingTransportation();
            $reason_using_transport->respondent_id = $respondent->id;
            $reason_using_transport->reason_using_transportation_choice_id = $request['reason_using_transport'][$i];
            $reason_using_transport->priority = $i+1;
            $reason_using_transport->save();
        }
        for ($i = 0; $i < count($request['mrt_improvement']); $i++) {
            $mrt_improvement = new App\MrtImprovement();
            $mrt_improvement->respondent_id = $respondent->id;
            $mrt_improvement->mrt_improvement_choice_id = $request['mrt_improvement'][$i];
            $mrt_improvement->priority = $i+1;
            $mrt_improvement->save();
        }
        $respondent->step_id = 5;
        $respondent->save();

        return response()->json(['message' => 'Informasi tambahan berhasil disimpan'], 200);

    }
    public function findRespondent($token)
    {
        $respondent = App\Respondent::where([
            'token' => $token,
        ])->first();

        if (!$respondent) {
            return response()->json(['message' => 'Responden tidak ditemukan'], 500);
        }
    }
}