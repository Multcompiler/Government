<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Study extends Model
{
    public function teacher(){
        return $this->belongsToMany('App\Teacher');
    }
}
