<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class IngredientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ingredients')->delete();
        $data = json_decode(File::get('database/temp-data/ingredients.json'));
        foreach ($data as $item) {
            Ingredient::create([
                'title' => $item->title,
                'best_before' => $item->best_before,
                'expired_at' => $item->expired_at,
                'stock' => $item->stock,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

    }
}
