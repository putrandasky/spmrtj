<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransportationMode extends Model
{
    public $timestamps = false;
    public function travel_details()
    {
        return $this->hasMany('App\TravelDetail');
    }
}
