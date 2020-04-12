<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SurveyPreference extends Model
{
    public $timestamps = false;
    public function survey_preference_respondents()
    {
        return $this->hasMany('App\SurveyPreferenceRespondent');
    }
}
