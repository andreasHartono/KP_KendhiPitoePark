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
      $accounts = 
      [
         [
            'username' => 'iwaniwan',
            'phone' => '0888181818181', 
            'name' => 'Iwan Bumdes', 
            'address' => 'jalan soekarno 1', 
            'password' => Hash::make("iwan1234"),           
            'jabatan' => 'owner'
         ],
         [
            'username' => 'pegawai1',
            'phone' => '088812312321', 
            'name' => 'Toto Pegawai 1', 
            'address' => 'jalan soekarno 2', 
            'password' => Hash::make("pegawai"),           
            'jabatan' => 'pegawai'
         ],
         [
            'username' => 'pegawai2',
            'phone' => '088812312321', 
            'name' => 'Titi Pegawai 2', 
            'address' => 'jalan soekarno 2', 
            'password' => Hash::make("pegawai2"),           
            'jabatan' => 'pegawai'
         ],
         [
            'username' => 'pelanggan1',
            'phone' => '088812312321', 
            'name' => 'Budi Pelanggan 1', 
            'address' => 'jalan soekarno 3', 
            'password' => Hash::make("pelanggan1"),           
            'jabatan' => 'pelanggan'
         ],
         [
            'username' => 'pelanggan2',
            'phone' => '088812312321', 
            'name' => 'Jason Pelanggan 2', 
            'address' => 'jalan soekarno 3', 
            'password' => Hash::make("pelanggan2"),           
            'jabatan' => 'pelanggan'
         ],
      ];

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
