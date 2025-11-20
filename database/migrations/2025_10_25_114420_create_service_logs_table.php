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
        Schema::create('service_logs', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name');
            $table->string('contact_number');
            $table->string('gmail');
            $table->string('motorcycle_brand');
            $table->string('motorcycle_model');
            $table->integer('mileage');
            $table->date('service_date');
            $table->unsignedBigInteger('service_id');

            $table->integer('next_due_mileage')->nullable();
            $table->date('next_due_date')->nullable();
            $table->text('ai_reasoning')->nullable();
            $table->text('remarks')->nullable();

            $table->string('road_condition')->nullable();
            $table->string('usage_frequency')->nullable();

            $table->timestamps(); 

             $table->foreign('service_id')->references('service_id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_logs');
    }
};
