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
        Schema::create('shop', function (Blueprint $table) {
            $table->id('shop_id');
            $table->string('shop_name');
            $table->string('province')->nullable();
            $table->string('city')->nullable();
            $table->string('barangay')->nullable();
            $table->string('shop_logo')->nullable();
            
            $table->boolean('enable_direct_buy')->default(true);
            $table->enum('service_area', ['nationwide', 'province', 'local'])->default('local');
            
            $table->boolean('payment_cod')->default(false);
            $table->boolean('payment_gcash')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shop');
    }
};
