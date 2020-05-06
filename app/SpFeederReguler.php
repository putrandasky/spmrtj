<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpFeederReguler extends Model
{
    public $timestamps = false;
    public function cost_preference()
    {
        return $this->belongsTo('App\CostPreference');
    }
    public function time_preference()
    {
        return $this->belongsTo('App\TimePreference');
    }
    public function respondent()
    {
        return $this->belongsTo('App\Respondent');
    }
}
