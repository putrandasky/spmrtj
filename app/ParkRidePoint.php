<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParkRidePoint extends Model
{
    public $timestamps = false;
    public function park_ride_point_respondents()
    {
        return $this->hasMany('App\ParkRidePointRespondent');
    }

}
