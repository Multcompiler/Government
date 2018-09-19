<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function study(){
        return $this->belongsToMany('App\Study');
    }

    public function kidato(){
        return $this->belongsToMany('App\Kidato');
    }
}
