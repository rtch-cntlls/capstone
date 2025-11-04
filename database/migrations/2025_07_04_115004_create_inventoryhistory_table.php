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
        Schema::create('inventoryhistory', function (Blueprint $table) {
            $table->id('inventoryhistory_id');
            $table->unsignedBigInteger('inventory_id');
            $table->integer('quantity');
            $table->dateTime('action_date');
            $table->timestamps();

            $table->foreign('inventory_id')->references('inventory_id')->on('inventory')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventoryhistory');
    }
};
