<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StationRespondent extends Model
{
    public $timestamps = false;
    public function station()
    {
        return $this->belongsTo('App\Station');
    }
    public function respondent()
    {
        return $this->belongsTo('App\Respondent');
    }

}
