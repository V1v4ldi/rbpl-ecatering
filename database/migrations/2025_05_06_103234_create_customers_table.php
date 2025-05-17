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
        Schema::create('customer', function (Blueprint $table) {
            $table->string('customer_id', length: 50)->primary();
            $table->string('name', length: 50);
            $table->string('email', length: 100)->unique();
            $table->string('password');
            $table->string('no_hp', length:15);
            $table->enum('role', ['customer','admin','owner']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
