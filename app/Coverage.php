<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coverage extends Model
{
    public $timestamps = false;

    public function area()
    {
        return $this->belongsTo('App\Area');
    }
}
