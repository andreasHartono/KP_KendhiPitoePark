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
      // $accounts = [
      //    ['username' => 'totototo','phone' => '123456789', 'name' => 'toto123', 'address' => 'jalan soekarno 1', 'password' => "totototo", 'is_admin' => '0', 'jabatan' => 'pelanggan'],
      // ];
      $accounts = [
         'username' => 'totototo',
         'phone' => '123456789', 
         'name' => 'toto123', 
         'address' => 'jalan soekarno 1', 
         'password' => Hash::make("totototo"), 
         'is_admin' => '0', 
         'jabatan' => 'pelanggan'];

      // foreach ($accounts as $account) {
      //    DB::table('users')->insert([
      //       'username' => $account['username'], 
      //       'phone' => $account['phone'], 
      //       'name' => $account['name'], 
      //       'address' => $account['address'], 
      //       'password' => Hash::make($account['password']), 
      //       'is_admin' => $account['is_admin'], 
      //       'jabatan' => $account['jabatan']
      //    ]);
         DB::table('users')->insert($accounts);
   }
}
