<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryFoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => 'Makanan Berat'],
            ['name' => 'Makanan Ringan'],
            ['name' => 'Minuman']             
        ];

        foreach($categories as $category) {
            DB::table('category_food')->insert(['name' => $category['name']]);
        }
    }
}
