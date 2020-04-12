<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParkRidePointRespondent extends Model
{
    public $timestamps = false;
    public function respondent()
    {
        return $this->belongsTo('App\Respondent');
    }
    public function park_ride_point()
    {
        return $this->belongsTo('App\ParkRidePoint');
    }
}
