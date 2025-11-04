<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('addresses', function (Blueprint $table) {
        $table->id('address_id');
        $table->unsignedBigInteger('customer_id'); 
        $table->string('street');
        $table->string('barangay');
        $table->string('city');
        $table->string('province');
        $table->string('postal_code');
        $table->timestamps();

        $table->foreign('customer_id')->references('customer_id')->on('customer')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
