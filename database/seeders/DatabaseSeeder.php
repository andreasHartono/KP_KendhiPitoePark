<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      //   $this->call([
      //       CategoryFoodSeeder::class,
      //       CafesSeeder::class,
      //   ]);
        $mejas = [
            ['no_meja' => '1','link' => 'www.google1.com'], 
            ['no_meja' => '2','link' => 'www.google2.com'],         
               
        ];

        foreach($mejas as $meja) {
            DB::table('mejas')->insert(['no_meja' => $meja['no_meja'],'link' => $meja['link']]);
        }
    }
}
