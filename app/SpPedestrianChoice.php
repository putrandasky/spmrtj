<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpPedestrianChoice extends Model
{
    public $timestamps = false;

    public function sp_pedestrian()
    {
        return $this->hasMany('App\SpPedestrian');
    }
}
