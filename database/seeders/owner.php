<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class owner extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('owner')->insert([
           'name' => 'owner', 
           'email' => 'owner@gmail.com', 
           'password' => bcrypt('owner12345'), 
        ]);
    }
}
