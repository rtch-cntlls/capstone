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
        Schema::create('motorcycle_maintenance_logs', function (Blueprint $table) {
            $table->id('log_id');
            $table->unsignedBigInteger('motorcycle_id');
            $table->string('service_type');
            $table->integer('mileage_at_service')->nullable();
            $table->date('last_done_at');
            $table->text('ai_reasoning')->nullable();
            $table->date('next_due_date')->nullable();
            $table->integer('next_due_mileage')->nullable();
            $table->timestamps();

            $table->foreign('motorcycle_id')->references('motorcycle_id')->on('motorcycles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motorcycle_maintenance_logs');
    }
};
