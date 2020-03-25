<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpCycleOther extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
    public function sp_cycle()
    {
        return $this->belongsTo('App\SpCycle');
    }
}
