<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MejasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mejas = [
            ['no_meja' => '1','link' => 'www.google1.com'], 
            ['no_meja' => '2','link' => 'www.google2.com'],         
               
        ];

        foreach($mejas as $meja) {
            DB::table('mejas')->insert(['no_meja' => $meja['no_meja'],'link' => $meja['link']]);
        }
    }
}
