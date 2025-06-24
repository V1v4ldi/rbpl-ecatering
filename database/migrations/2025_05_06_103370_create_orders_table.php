<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order', function (Blueprint $table) {
            $table->string('order_id')->primary();
            $table->string('customer_id')->nullable();
            $table->string('admin_id')->nullable();
            $table->foreign('customer_id')->references('customer_id')->on('customer')->onDelete('cascade');
            $table->foreign('admin_id')->references('admin_id')->on('admin')->onDelete('cascade');
            $table->date('tanggal_kirim');
            $table->time('waktu');
            $table->string('alamat');
            $table->string('catatan');
            $table->unsignedInteger('jumlah');
            $table->enum('status_pesanan', ['Belum Dibayar', 'Sedang Diverifikasi', 'Sudah Diverifikasi', 'Sedang Dibuat', 'Dalam Pengiriman', 'Selesai'])->default('Belum Dibayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order');
    }
};
