<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $accounts = [
            ['username' => 'totototo','password' => "totototo",'phone'=>'123456789','name'=>'toto123','address'=>'jalan soekarno 1','is_admin'=>'0','jabatan'=>'pelanggan'],
        ];        
        
        foreach($accounts as $account) {
            DB::table('accounts')->insert(['name' => $account['name'],'password' => $account['password'],'username' => $account['username'],'phone' => $account['phone'],'address' => $account['address'],'is_admin' => $account['is_admin'],'jabatan' => $account['jabatan']]);
        }
    }
}
