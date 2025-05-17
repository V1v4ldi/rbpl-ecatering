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
            $table->string('order_id', length: 50)->primary();
            $table->string('product_id', length: 50);
            $table->string('customer_id', length: 50);
            $table->foreign('product_id')->references('product_id')->on('product')->onDelete('cascade');
            $table->foreign('customer_id')->references('customer_id')->on('customer')->onDelete('cascade');
            $table->unsignedInteger('jumlah');
            $table->date('tanggal_order');
            $table->string('alamat', length: 100);
            $table->boolean('status_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
