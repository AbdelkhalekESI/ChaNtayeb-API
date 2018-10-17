<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    public function meal(){
        return $this->belongsToMany('App\Meal');
    }
}
