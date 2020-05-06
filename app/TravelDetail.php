<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelDetail extends Model
{
    public $timestamps = false;
    public function transportation_mode()
    {
        return $this->belongsTo('App\TransportationMode');
    }
    public function respondent()
    {
        return $this->belongsTo('App\Respondent');
    }
}
