<?php

namespace App\Http\Controllers\Api;

use App\Http\Resources\MealResource;
use App\Meal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;


class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $meals=Meal::all();
        return MealResource::collection($meals);
    }

    /**
     * Display the specified resource.
     *
     * @param Meal $meal
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Meal $meal)
    {
        $meal=Meal::with('ingredient')->get()->where('id','=',$meal->id)->toArray();
       return Response::json($meal);
       //return new MealResource($meal);
    }




}
