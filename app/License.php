<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    public $timestamps = false;
    public function respondents()
    {
        return $this->hasMany('App\Respondent');
    }
}
