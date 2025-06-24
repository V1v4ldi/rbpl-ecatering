<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('daily_report', function (Blueprint $table) {
            $table->string('report_d_id')->primary();
            $table->string('report_id');
            $table->string('order_id');
            $table->date('tanggal');
            $table->timestamps();

            $table->foreign('report_id')->references('report_id')->on('report')->onDelete('cascade');
            $table->foreign('order_id')->references('order_id')->on('order')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_report');
    }
};
