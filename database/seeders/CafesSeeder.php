<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CafesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cafes = [
            ['name' => 'Nasi Goreng', 'image'=>'123.jpg','price'=>'10000','description'=>'Pedas','category_id'=>1],
            ['name' => 'Es Teh', 'image'=>'123.jpg','price'=>'10000','description'=>'Pedas','category_id'=>2],
            ['name' => 'Pisang Goreng', 'image'=>'123.jpg','price'=>'10000','description'=>'Pedas','category_id'=>3],
            
        ];

        foreach($cafes as $cafe) {
            DB::table('cafes')->insert(['name' => $cafe['name'], 'images' => $cafe['image'], 'price' => $cafe['price'], 'description' => $cafe['description'], 'category_id' => $cafe['category_id']]);
        }
    }
}
