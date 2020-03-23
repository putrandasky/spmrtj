<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WayPointFeeder extends Model
{
    public $timestamps = false;
    public function source()
    {
        return $this->belongsTo('App\StationFeeder', 'source_id');
    }
    public function after()
    {
        return $this->belongsTo('App\StationFeeder', 'after_id');
    }
}
