<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function region(){
        return $this->belongsTo('App\Region');
    }

    public function wards(){
        return $this->hasMany('App\Ward');
    }
}
