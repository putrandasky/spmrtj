<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    public $timestamps = false;
    public function way_points()
    {
        return $this->hasMany('App\WayPoint','source_id','id');
    }
}
