<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HeadMasterProfile extends Model
{
    public function user(){
        return $this->belongsTo('App\Role');
    }
}
