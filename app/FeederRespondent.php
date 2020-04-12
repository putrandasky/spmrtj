<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeederRespondent extends Model
{
    public $timestamps = false;
    public function station_feeder()
    {
        return $this->belongsTo('App\StationFeeder');
    }
    public function respondent()
    {
        return $this->belongsTo('App\Respondent');
    }
}
