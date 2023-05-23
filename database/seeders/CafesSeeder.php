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
            ['name' => 'Nasi Goreng', 'image'=>'nasigoreng.jpg','price'=>'15000','description'=>'Pedas','category_id'=>1],
            ['name' => 'Es Teh', 'image'=>'esteh.jpg','price'=>'6000','description'=>'Dengan Madu','category_id'=>3],
            ['name' => 'Pisang Goreng', 'image'=>'pisanggoreng.jpg','price'=>'10000','description'=>'Berisi 3 pisang','category_id'=>2],
            ['name' => 'Mie Goreng', 'image'=>'miegoreng.jpg','price'=>'15000','description'=>'Pedas Manis','category_id'=>1],
            ['name' => 'Es jeruk', 'image'=>'esteh.jpg','price'=>'8000','description'=>'Manis dan Kecut','category_id'=>3],
            ['name' => 'Tempe Goreng', 'image'=>'tempegoreng.jpg','price'=>'10000','description'=>'Berisi 5 tempe','category_id'=>2],
            
        ];

        foreach($cafes as $cafe) {
            DB::table('cafes')->insert(['name' => $cafe['name'], 'image' => $cafe['image'], 'price' => $cafe['price'], 'description' => $cafe['description'], 'category_id' => $cafe['category_id']]);
        }
    }
}
