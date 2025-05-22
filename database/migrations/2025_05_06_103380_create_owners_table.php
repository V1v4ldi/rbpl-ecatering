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
            $table->string('owner_id', length: 50)->primary();
            $table->string('nama', length: 50);
            $table->string('email', length: 50);
            $table->string('password');
            $table->string('no_hp', length: 15);
            $table->enum('role', ['customer','admin','owner'])->default('owner');
            $table->string('report_id', length: 50)->nullable();
            $table->foreign('report_id')->references('report_id')->on('report');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('owners');
    }
};
