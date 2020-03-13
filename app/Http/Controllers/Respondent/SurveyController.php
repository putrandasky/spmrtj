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

    public function getTravelData()
    {
        $data['travel_purposes'] = App\TravelPurpose::all();
        $data['travel_modes'] = App\TravelMode::all();
        $data['parking_guarantors'] = App\ParkingGuarantor::all();
        $data['parking_types'] = App\ParkingType::all();
        $data['coverages']['parkir'] = App\Coverage::where('area_id',1)->get();
        $data['coverages']['cycle'] = App\Coverage::where('area_id',2)->get();
        $data['coverages']['pedestrian'] = App\Coverage::where('area_id',3)->get();
        $data['coverages']['park_and_ride'] = App\Coverage::where('area_id',4)->get();
        $data['coverages']['feeder'] = App\Coverage::where('area_id',5)->get();
        return $data;
    }

    public function getAdditionalData()
    {
        $data['reason_using_transportation_choices'] = App\ReasonUsingTransportationChoice::all();
        $data['mrt_improvement_choices'] = App\MrtImprovementChoice::all();
        $data['work_place_parking_system'] = App\WorkPlaceParkingSystem::all();
        $data['willingness_public_transport_trip'] = App\WillingnessPublicTransportTrip::all();
        return $data;
    }
}
