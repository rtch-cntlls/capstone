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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('order_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('address_id')->nullable(); 
            $table->string('order_number', 50)->unique();
            $table->enum('status', ['pending','processing','out_for_delivery', 'shipped', 'ready_for_pick_up','completed','cancelled'])->default('pending');
            $table->enum('payment_status', ['unpaid','pending','paid','failed'])->default('unpaid');
            $table->string('payment_method')->nullable();   
            $table->string('payment_proof')->nullable();
            $table->string('gcash_reference', 50)->nullable();
            $table->enum('delivery_type', ['pick-up', 'deliver']);
            $table->enum('order_type', ['local', 'province', 'nationwide']);
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('discount_total', 10, 2)->default(0);
            $table->decimal('grand_total', 10, 2)->default(0);
            $table->timestamp('placed_at')->nullable();
            $table->timestamp('expected_delivery_date')->nullable();
            $table->timestamp('delivered_at')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();
            
            $table->foreign('address_id')->references('address_id')->on('addresses')->onDelete('cascade');
            $table->foreign('customer_id')->references('customer_id')->on('customer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
