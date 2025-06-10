<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\admin as modelsadmin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class admin extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       modelsadmin::create([
            'name' => 'admin', 
            'email' => 'admin@gmail.com', 
            'password' => bcrypt('admin12345'), 
            'no_hp' => '081213197852', 
        ]);
    }
}
