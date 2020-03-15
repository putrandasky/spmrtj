<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpCarParking extends Model
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
    public function time_preference()
    {
        return $this->belongsTo('App\TimePreference');
    }
}
