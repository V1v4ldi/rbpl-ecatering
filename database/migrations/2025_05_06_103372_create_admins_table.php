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
        Schema::create('admin', function (Blueprint $table) {
            $table->string('admin_id', length: 50)->primary();
            $table->string('nama', length: 50);
            $table->string('email', length: 100);
            $table->string('password');
            $table->enum('role', ['customer','admin','owner'])->default('admin');
            $table->string('order_id', length: 50)->nullable();
            $table->foreign('order_id')->references('order_id')->on('order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
