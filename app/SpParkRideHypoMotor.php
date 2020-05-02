<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpParkRideHypoMotor extends Model
{
    public $timestamps = false;
    public function respondent()
    {
        return $this->belongsTo('App\Respondent');
    }
}
