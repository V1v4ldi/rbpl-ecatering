<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\product as ProductModels;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class product extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductModels::insert([
           ['nama' => 'Acar', 
           'harga' => 5000, 
           'Deskripsi' => 'ini masih testing', 
           'imgname' => 'Acar.jpg',
            'created_at' => NOW(),
            'updated_at' => NOW(),],
           ['nama' => 'Ayam Bakar', 
           'harga' => 5000, 
           'Deskripsi' => 'ini masih testing', 
           'imgname' => 'Ayam Bakar.jpg',
            'created_at' => NOW(),
            'updated_at' => NOW(),],
           ['nama' => 'Ayam Balado', 
           'harga' => 5000, 
           'Deskripsi' => 'ini masih testing', 
           'imgname' => 'Ayam Balado.jpg',
            'created_at' => NOW(),
            'updated_at' => NOW(),],
           ['nama' => 'Ayam Kecap', 
           'harga' => 5000, 
           'Deskripsi' => 'ini masih testing', 
           'imgname' => 'Ayam Kecap.jpg',
            'created_at' => NOW(),
            'updated_at' => NOW(),],
           ['nama' => 'Capcay', 
           'harga' => 5000, 
           'Deskripsi' => 'ini masih testing', 
           'imgname' => 'Capcay.jpg',
            'created_at' => NOW(),
            'updated_at' => NOW(),],
           ['nama' => 'Kentang Balado', 
           'harga' => 5000, 
           'Deskripsi' => 'ini masih testing', 
           'imgname' => 'Kentang Balado.jpg',
            'created_at' => NOW(),
            'updated_at' => NOW(),],
           ['nama' => 'Mie Kuning', 
           'harga' => 5000, 
           'Deskripsi' => 'ini masih testing', 
           'imgname' => 'Mie Kuning.jpg',
            'created_at' => NOW(),
            'updated_at' => NOW(),],
           ['nama' => 'Rendang', 
           'harga' => 5000, 
           'Deskripsi' => 'ini masih testing', 
           'imgname' => 'Rendang.jpg',
            'created_at' => NOW(),
            'updated_at' => NOW(),],
        ]);
    }
}
