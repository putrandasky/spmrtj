<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Respondent extends Model
{

    public function step()
    {
        return $this->belongsTo('App\Step');
    }
    public function area_origins()
    {
        return $this->hasMany('App\AreaOrigin');
    }
    public function area_destinations()
    {
        return $this->hasMany('App\AreaDestination');
    }
    public function travel_details()
    {
        return $this->hasMany('App\TravelDetail');
    }
    public function sp_cycles()
    {
        return $this->hasMany('App\SpCycle');
    }
    public function sp_pedestrians()
    {
        return $this->hasMany('App\SpPedestrian');
    }
    public function sp_car_parkings()
    {
        return $this->hasMany('App\SpCarParking');
    }
    public function sp_motor_parkings()
    {
        return $this->hasMany('App\SpMotorParking');
    }
    public function survey_preference_respondents()
    {
        return $this->hasMany('App\SurveyPreferenceRespondent');
    }
    public function station_respondents()
    {
        return $this->hasMany('App\StationRespondent');
    }
    public function age()
    {
        return $this->belongsTo('App\Age');
    }
    public function gender()
    {
        return $this->belongsTo('App\Gender');
    }
    public function education()
    {
        return $this->belongsTo('App\Education');
    }
    public function job()
    {
        return $this->belongsTo('App\Job');
    }
    public function income()
    {
        return $this->belongsTo('App\Income');
    }
    public function expense()
    {
        return $this->belongsTo('App\Expense');
    }
    public function travel_expense()
    {
        return $this->belongsTo('App\TravelExpense');
    }
    public function travel_guarantor()
    {
        return $this->belongsTo('App\TravelGuarantor');
    }
    public function parking_guarantor()
    {
        return $this->belongsTo('App\ParkingGuarantor');
    }
    public function parking_type()
    {
        return $this->belongsTo('App\ParkingType');
    }
    public function license()
    {
        return $this->belongsTo('App\License');
    }
    public function vehicle()
    {
        return $this->belongsTo('App\Vehicle');
    }
    public function travel_purpose()
    {
        return $this->belongsTo('App\TravelPurpose');
    }
    public function sp_car_respond($timeId, $costId)
    {
        return $this->sp_car_parkings()->where(['time_preference_id' => $timeId, 'cost_preference_id' => $costId])->first();
    }
    public function sp_motor_respond($timeId, $costId)
    {
        return $this->sp_motor_parkings()->where(['time_preference_id' => $timeId + 4, 'cost_preference_id' => $costId + 6])->first();
    }
    public function sp_cycle_respond($question_id, $choice_id)
    {
        return $this->sp_cycles()->where(['question_id' => $question_id, 'sp_cycle_choice_id' => $choice_id])->first();
    }
    public function sp_pedestrian_respond($question_id, $choice_id)
    {
        return $this->sp_pedestrians()->where(['question_id' => $question_id, 'sp_pedestrian_choice_id' => $choice_id])->first();
    }
    public function sp_feeder_regulers()
    {
        return $this->hasMany('App\SpFeederReguler');
    }
    public function sp_feeder_reguler_respond($time_id, $cost_id)
    {
        return $this->sp_feeder_regulers()->where(['time_preference_id' => $time_id + 8, 'cost_preference_id' => $cost_id + 10])->first();
    }
    public function sp_feeder_premia()
    {
        return $this->hasMany('App\SpFeederPremium');
    }
    public function sp_feeder_premium_respond($cost_id)
    {
        return $this->sp_feeder_premia()->where(['cost_preference_id' => $cost_id + 16])->first();
    }
    public function sp_feeder_parks()
    {
        return $this->hasMany('App\SpFeederPark');
    }
    public function sp_feeder_park_respond($cost_id)
    {
        return $this->sp_feeder_parks()->where(['cost_preference_id' => $cost_id + 21])->first();
    }
    public function sp_park_ride_commons()
    {
        return $this->hasMany('App\SpParkRideCommon');
    }
    public function sp_park_ride_common_respond($question_id, $respond)
    {
        return $this->sp_park_ride_commons()->where(['question_id' => $question_id, 'respond' => $respond])->first();
    }
    public function sp_park_ride_primary_cars()
    {
        return $this->hasMany('App\SpParkRidePrimaryCar');
    }

    public function sp_park_ride_primary_car_respond($cost_id)
    {
        return $this->sp_park_ride_primary_cars()->where(['cost_preference_id' => $cost_id + 27])->first();
    }
    public function sp_park_ride_primary_motors()
    {
        return $this->hasMany('App\SpParkRidePrimaryMotor');
    }

    public function sp_park_ride_primary_motor_respond($cost_id)
    {
        return $this->sp_park_ride_primary_motors()->where(['cost_preference_id' => $cost_id + 34])->first();
    }
    public function sp_park_ride_hypo_cars()
    {
        return $this->hasMany('App\SpParkRideHypoCar');
    }

    public function sp_park_ride_hypo_car_respond($question_id)
    {
        return $this->sp_park_ride_hypo_cars()->where(['question_id' => $question_id])->first();
    }
    public function sp_park_ride_hypo_motors()
    {
        return $this->hasMany('App\SpParkRideHypoMotor');
    }

    public function sp_park_ride_hypo_motor_respond($question_id)
    {
        return $this->sp_park_ride_hypo_motors()->where(['question_id' => $question_id])->first();
    }
    public function mrt_improvements()
    {
        return $this->hasMany('App\MrtImprovement');
    }
    public function mrt_improvement_respond($mrt_improvements_id)
    {
        return $this->mrt_improvements()->where(['mrt_improvement_choice_id' => $mrt_improvements_id])->first();
    }
    public function reason_using_transportations()
    {
        return $this->hasMany('App\ReasonUsingTransportation');
    }
    public function reason_using_transportation_respond($reason_using_transportation_id)
    {
        return $this->reason_using_transportations()->where(['reason_using_transportation_choice_id' => $reason_using_transportation_id])->first();
    }
    public function work_place_parking_system()
    {
        return $this->belongsTo('App\WorkPlaceParkingSystem');
    }
    public function willingness_public_transport_trip()
    {
        return $this->belongsTo('App\WillingnessPublicTransportTrip');
    }
}
