<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpCycleChoice extends Model
{
    public $timestamps = false;
    public function sp_cycle()
    {
        return $this->hasMany('App\SpCycle');
    }
}
