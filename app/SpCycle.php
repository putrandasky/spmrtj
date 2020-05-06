<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpCycle extends Model
{
    public $timestamps = false;
    public function sp_cycle_other()
    {
        return $this->hasOne('App\SpCycleOther');
    }
    public function sp_cycle_choice()
    {
        return $this->belongsTo('App\SpCycleChoice');
    }
    public function respondent()
    {
        return $this->belongsTo('App\Respondent');
    }
}
