<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{


    public function ingredient(){
        return $this->belongsToMany('App\Ingredient','meal_ingredient');
    }

    public function disease(){
        return $this->belongsToMany('App\Disease');
    }

    public function ingredientsNames(){
        return $this->ingredient->pluck('name')->toArray();
    }

    public function diseasesNames(){
        return $this->disease->pluck('name')->toArray();
    }

}
