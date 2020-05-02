<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpParkRidePrimaryMotor extends Model
{
    public $timestamps = false;
    public function respondent()
    {
        return $this->belongsTo('App\Respondent');
    }
    public function cost_preference()
    {
        return $this->belongsTo('App\CostPreference');
    }
}
