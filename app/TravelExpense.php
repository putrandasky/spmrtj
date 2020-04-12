<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TravelExpense extends Model
{
    public $timestamps = false;
    public function respondents()
    {
        return $this->hasMany('App\Respondent');
    }
}
