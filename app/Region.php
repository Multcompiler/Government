<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    public function district(){
        return $this->hasMany('App\District');
    }
}
