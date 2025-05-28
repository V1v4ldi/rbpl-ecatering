<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class customer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('customer')->insert([
           'name' => 'test', 
           'email' => 'test@gmail.com', 
           'password' => bcrypt('test12345'), 
           'no_hp' => '081213195278', 
        ]);
    }
}
