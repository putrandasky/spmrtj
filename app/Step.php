<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    public $timestamps = false;
    public function respondents()
    {
        return $this->hasMany('App\Respondent');
    }
}
