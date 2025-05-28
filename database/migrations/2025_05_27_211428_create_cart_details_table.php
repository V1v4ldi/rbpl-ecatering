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
        Schema::create('cart_detail', function (Blueprint $table) {
            $table->string('cart_d_id')->primary();
            $table->string('product_id');
            $table->foreign('product_id')->references('product_id')->on('product')->onDelete('cascade');
            $table->string('cart_id');
            $table->foreign('cart_id')->references('cart_id')->on('cart')->onDelete('cascade');
            $table->unsignedBigInteger('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_detail');
    }
};
