<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelGuarantor extends Model
{
    public $timestamps = false;
    public function respondents()
    {
        return $this->hasMany('App\Respondent');
    }
}
