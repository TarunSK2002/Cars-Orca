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
        Schema::create('car_conditions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained('cars')->onDelete('cascade');
            $table->string('engine_condition')->nullable();
            $table->string('transmission_condition')->nullable();
            $table->string('body_condition')->nullable();
            $table->string('paint_condition')->nullable();
            $table->string('interior_condition')->nullable();
            $table->string('electrical_system')->nullable();
            $table->string('tyre_condition')->nullable();
            $table->string('ac_condition')->nullable();
            $table->string('brake_system')->nullable();
            $table->string('suspension_condition')->nullable();
            $table->text('overall_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_conditions');
    }
};
