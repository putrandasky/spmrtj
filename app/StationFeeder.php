<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StationFeeder extends Model
{
    public $timestamps = false;
    public function way_points()
    {
        return $this->hasMany('App\WayPointFeeder','source_id','id');
    }
}
