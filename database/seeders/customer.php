<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\customer as ModelsCustomer;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class customer extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsCustomer::create([
           'name' => 'test', 
           'email' => 'test@gmail.com', 
           'password' => bcrypt('test12345'), 
           'no_hp' => '081213195278', 
        ]);
    }
}
