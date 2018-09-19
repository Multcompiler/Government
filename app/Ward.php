<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    public function districts(){
        return $this->belongsTo('App\District');
    }
}
