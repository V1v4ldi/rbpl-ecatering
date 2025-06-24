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
        Schema::create('owner', function (Blueprint $table) {
            $table->string('owner_id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('no_hp', length:15);
            $table->enum('role', ['owner'])->default('owner');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owner');
    }
};
