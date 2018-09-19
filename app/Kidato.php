<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kidato extends Model
{
    public function teacher(){
        return $this->belongsToMany('App\Teacher');
    }
}
