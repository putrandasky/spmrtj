<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WayPoint extends Model
{
    public $timestamps = false;
    public function source()
    {
        return $this->belongsTo('App\Station', 'source_id');
    }
    public function after()
    {
        return $this->belongsTo('App\Station', 'after_id');
    }
}
