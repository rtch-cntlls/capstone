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
        Schema::create('discounts', function (Blueprint $table) {
            $table->id('discount_id');
            $table->string('title');
            $table->enum('promo_type', ['Single', 'Bundle']);
            $table->decimal('discount_percent', 5, 2);
            $table->date('start_date');
            $table->date('expiry_date');
            $table->enum('status', ['Active', 'Expired', 'Upcoming']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('discount');
    }
};
