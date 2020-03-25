<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpPedestrianOther extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
    public function sp_pedestrian()
    {
        return $this->belongsTo('App\SpPedestrian');
    }
}
