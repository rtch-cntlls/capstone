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
        Schema::table('service_logs', function (Blueprint $table) {
            $table->string('gmail')->nullable()->after('contact_number');
            $table->string('motorcycle_brand')->nullable()->after('gmail');
            $table->string('motorcycle_model')->nullable()->after('motorcycle_brand');
            $table->integer('last_mileage')->nullable()->after('motorcycle_model');
            $table->date('last_service_date')->nullable()->after('last_mileage');
            $table->string('last_service_type')->nullable()->after('last_service_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_logs', function (Blueprint $table) {
            $table->dropColumn([
                'gmail',
                'motorcycle_brand',
                'motorcycle_model',
                'last_mileage',
                'last_service_date',
                'last_service_type',
            ]);
        });
    }
};
