<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\order_detail as OrderDetailModels;

class order_detail extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderDetailModels::insert([
            [
                'order_id' => 'ORDER-0011',
                'product_id' => 'PRODUCT-0002',
                'harga_now' => '5000',
            ],
            [
                'order_id' => 'ORDER-0012',
                'product_id' => 'PRODUCT-0001',
                'harga_now' => '5000',
            ],
            [
                'order_id' => 'ORDER-0013',
                'product_id' => 'PRODUCT-0004',
                'harga_now' => '5000',
            ],
            [
                'order_id' => 'ORDER-0014',
                'product_id' => 'PRODUCT-0006',
                'harga_now' => '5000',
            ],
            [
                'order_id' => 'ORDER-0015',
                'product_id' => 'PRODUCT-0005',
                'harga_now' => '5000',
            ],
            [
                'order_id' => 'ORDER-0016',
                'product_id' => 'PRODUCT-0008',
                'harga_now' => '5000',
            ],
            [
                'order_id' => 'ORDER-0017',
                'product_id' => 'PRODUCT-0003',
                'harga_now' => '5000',
            ],
            [
                'order_id' => 'ORDER-0018',
                'product_id' => 'PRODUCT-0001',
                'harga_now' => '5000',
            ],
            [
                'order_id' => 'ORDER-0019',
                'product_id' => 'PRODUCT-0005',
                'harga_now' => '5000',
            ],
            [
                'order_id' => 'ORDER-0020',
                'product_id' => 'PRODUCT-0002',
                'harga_now' => '5000',
            ],
            [
                'order_id' => 'ORDER-0021',
                'product_id' => 'PRODUCT-0001',
                'harga_now' => '5000',
            ],
        ]);
    }
}
