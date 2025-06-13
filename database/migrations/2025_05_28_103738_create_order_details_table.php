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
        Schema::create('order_detail', function (Blueprint $table) {
            $table->string('order_d_id')->primary();
            $table->string('order_id');
            $table->foreign('order_id')->references('order_id')->on('order')->onDelete('cascade');
            $table->string('product_id');
            $table->foreign('product_id')->references('product_id')->on('product')->onDelete('cascade');
            $table->unsignedInteger('harga_now');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_detail');
    }
};
