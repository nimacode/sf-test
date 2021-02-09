<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use HasFactory;

    protected $table = 'foods';
    protected $with = [
        'ingredients'
    ];

    protected $fillable = [
        'title'
    ];

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'ingredient_food');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
