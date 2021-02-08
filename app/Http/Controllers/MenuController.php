<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        $endIngredientFoodIds = DB::table('ingredient_food')
            ->join('ingredients', 'ingredients.id', '=', 'ingredient_food.ingredient_id')
            ->where('ingredients.stock', 0)
            ->pluck('food_id');

        $expiredIngredientFoodIds = DB::table('ingredient_food')
            ->join('ingredients', 'ingredients.id', '=', 'ingredient_food.ingredient_id')
            ->whereDate('ingredients.expired_at', '<', date("Y-m-d"))
            ->pluck('food_id');

        $endBestBeforeFoodIds = DB::table('ingredient_food')
            ->join('ingredients', 'ingredients.id', '=', 'ingredient_food.ingredient_id')
            ->whereDate('ingredients.best_before', '<', date("Y-m-d"))
            ->whereDate('ingredients.expired_at', '>', date("Y-m-d"))
            ->pluck('food_id');

        $foods = Food::all()
            ->whereNotIn('foods.id', $endIngredientFoodIds)
            ->whereNotIn('foods.id', $expiredIngredientFoodIds);

        return $foods;
    }
}
