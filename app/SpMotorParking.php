<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpMotorParking extends Model
{
    public $timestamps = false;

    public function respondent()
    {
        return $this->belongsTo('App\Respondent');
    }
    public function cost()
    {
        return $this->belongsTo('App\CostPreference');
    }
    public function time()
    {
        return $this->belongsTo('App\TimePreference');
    }
}
