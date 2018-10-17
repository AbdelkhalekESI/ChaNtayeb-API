<?php

namespace App\Http\Controllers;

use App\Ingredient;
use App\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class SearchController extends Controller
{
    public function index(Request $request){
        $ingredients = Ingredient::where('name','like', "%{$request->q}%")->get()->take(3);
        return $ingredients;
    }

    public function show(Request $request){
        $meals = Meal::with('ingredient','disease')
            ->where('calories','<=',intval($request['cal']))
            ->where('cookingTime','<=',intval($request['cook']))
            ->get();

        $max=0;

        $bestmeal=null;

        $ingredients=explode(',',$request->ing);
        $diseases=explode(',',$request->dis);

        foreach ($meals as $meal){
            $count =0;
            $i=0;
            foreach ($ingredients as $ingredient){

                if (in_array($ingredient, $meal->ingredientsNames())){
                    $count++;
                }
            }

            $no=false;

            foreach ($diseases as $disease){

                if (in_array($disease, $meal->diseasesNames())){
                    $no=true;
                }
            }

            if ($no) $meals->forget($i);

            if (sizeof($meal->ingredientsNames())!=0) $meal['percentage']=$count/sizeof($meal->ingredientsNames());
            else $meal['percentage']=0;
            $meal['percentage']=intval($meal['percentage']*100);
            $i++;

        }
        $sorted=$meals->sortByDesc('percentage');
        return Response::json($sorted);
    }
}
