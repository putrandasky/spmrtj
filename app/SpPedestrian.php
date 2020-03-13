<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpPedestrian extends Model
{
    public $timestamps = false;

    public function respondent()
    {
        return $this->belongsTo('App\Respondent');
    }

    public function choice()
    {
        return $this->belongsTo('App\TimePreference');
    }
}
