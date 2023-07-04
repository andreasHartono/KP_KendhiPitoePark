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
            ['no_meja' => '1','link' => '1',"meja_hash" => "t"], 
            ['no_meja' => '2','link' => '2',"meja_hash" => "t"], 
            ['no_meja' => '3','link' => '3',"meja_hash" => "t"],        
               
        ];

        foreach($mejas as $meja) {
            DB::table('mejas')->insert(['no_meja' => $meja['no_meja'],'link' => $meja['link'],'meja_hash' => $meja['meja_hash']]);
        }
    }
}
