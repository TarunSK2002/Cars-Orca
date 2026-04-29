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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('company');
            $table->string('model');
            $table->string('year_of_manufacture')->nullable();
            $table->string('year_of_purchase')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('owner_count')->nullable(); // e.g., '1st', '2nd'
            $table->integer('km_driven')->nullable();
            $table->string('fuel_type')->nullable(); // e.g., 'Petrol', 'Diesel'
            $table->string('transmission')->nullable(); // e.g., 'Manual', 'Auto'
            $table->string('color')->nullable();
            $table->decimal('car_price', 12, 2)->default(0);
            $table->decimal('broker_amount', 12, 2)->default(0);
            $table->decimal('total_price', 12, 2)->default(0);
            $table->enum('status', ['Available', 'Sold'])->default('Available');
            $table->date('purchase_date')->nullable();
            $table->date('sell_date')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
