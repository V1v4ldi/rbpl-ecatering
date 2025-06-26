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
        Schema::create('report', function (Blueprint $table) {
            $table->string('report_id')->primary();
            $table->string('owner_id');
            $table->enum('type', ['monthly', 'yearly']);
            $table->string('period', 10);
            $table->bigInteger('total_revenue')->default(0);
            $table->unsignedInteger('total_order')->default(0);
            $table->bigInteger('average_order')->default(0);
            $table->string('best_seller')->nullable();
            $table->index(['type', 'period']);
            $table->timestamps();

            $table->foreign('owner_id')->references('owner_id')->on('owner')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report');
    }
};
