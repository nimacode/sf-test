<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function orderFactory(OrderRequest $request)
    {
        $order = Order::create([
            'food_id' => $request->food_id,
            'user_id' => $request->user_id
        ]);

        if ($order && $order instanceof Order) {
            $ingredientsOfFood = DB::table('ingredients')
                ->join('ingredient_food', 'ingredient_food.ingredient_id', '=', 'ingredients.id')
                ->join('foods', 'ingredient_food.food_id', '=', 'foods.id')
                ->pluck('ingredients.id');

            $updateIngredientStock = DB::table('ingredients')
                ->whereIn('id', $ingredientsOfFood)
                ->increment('stock', 1);

            return "Order Created Successfully";
        }
    }
}
