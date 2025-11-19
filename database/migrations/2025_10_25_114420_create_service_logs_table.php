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
            $table->string('customer_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('gmail')->nullable();
            $table->string('motorcycle_brand')->nullable();
            $table->string('motorcycle_model')->nullable();
            $table->integer('last_mileage')->nullable();
            $table->date('last_service_date')->nullable();
            $table->string('last_service_type')->nullable();

            $table->integer('next_due_mileage')->nullable();
            $table->date('next_due_date')->nullable();
            $table->text('ai_reasoning')->nullable();
            $table->text('remarks')->nullable();

            $table->timestamps(); 

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
