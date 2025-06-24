<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\order as ModelsOrder;

class order extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelsOrder::insert([
            [
                'customer_id' => 'CUST-0001',
                'tanggal_kirim' => '2025-05-10',
                'waktu' => '10:00:00',
                'alamat' => 'ini',
                'catatan' => 'testing',
                'jumlah' => '51',
                'status_pesanan' => 'Selesai',
            ],
            [
                'customer_id' => 'CUST-0001',
                'tanggal_kirim' => '2025-05-11',
                'waktu' => '10:00:00',
                'alamat' => 'ini',
                'catatan' => 'testing',
                'jumlah' => '51',
                'status_pesanan' => 'Selesai',
            ],
            [
                'customer_id' => 'CUST-0001',
                'tanggal_kirim' => '2025-05-12',
                'waktu' => '10:00:00',
                'alamat' => 'ini',
                'catatan' => 'testing',
                'jumlah' => '51',
                'status_pesanan' => 'Selesai',
            ],
            [
                'customer_id' => 'CUST-0001',
                'tanggal_kirim' => '2025-05-13',
                'waktu' => '10:00:00',
                'alamat' => 'ini',
                'catatan' => 'testing',
                'jumlah' => '51',
                'status_pesanan' => 'Selesai',
            ],
            [
                'customer_id' => 'CUST-0001',
                'tanggal_kirim' => '2025-05-14',
                'waktu' => '10:00:00',
                'alamat' => 'ini',
                'catatan' => 'testing',
                'jumlah' => '51',
                'status_pesanan' => 'Selesai',
            ],
            [
                'customer_id' => 'CUST-0001',
                'tanggal_kirim' => '2025-04-15',
                'waktu' => '10:00:00',
                'alamat' => 'ini',
                'catatan' => 'testing',
                'jumlah' => '51',
                'status_pesanan' => 'Selesai',
            ],
            [
                'customer_id' => 'CUST-0001',
                'tanggal_kirim' => '2025-05-10',
                'waktu' => '10:00:00',
                'alamat' => 'ini',
                'catatan' => 'testing',
                'jumlah' => '51',
                'status_pesanan' => 'Selesai',
            ],
            [
                'customer_id' => 'CUST-0001',
                'tanggal_kirim' => '2025-05-11',
                'waktu' => '10:00:00',
                'alamat' => 'ini',
                'catatan' => 'testing',
                'jumlah' => '51',
                'status_pesanan' => 'Selesai',
            ],
            [
                'customer_id' => 'CUST-0001',
                'tanggal_kirim' => '2025-05-11',
                'waktu' => '10:00:00',
                'alamat' => 'ini',
                'catatan' => 'testing',
                'jumlah' => '51',
                'status_pesanan' => 'Selesai',
            ],
            [
                'customer_id' => 'CUST-0001',
                'tanggal_kirim' => '2025-05-12',
                'waktu' => '10:00:00',
                'alamat' => 'ini',
                'catatan' => 'testing',
                'jumlah' => '51',
                'status_pesanan' => 'Selesai',
            ],
            [
                'customer_id' => 'CUST-0001',
                'tanggal_kirim' => '2025-05-13',
                'waktu' => '10:00:00',
                'alamat' => 'ini',
                'catatan' => 'testing',
                'jumlah' => '51',
                'status_pesanan' => 'Selesai',
            ],
        ]);
    }
}
