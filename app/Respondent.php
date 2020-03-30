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
}
