<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    public function meal(){
        return $this->belongsToMany('App\Meal','meal_ingredient');
    }
}
