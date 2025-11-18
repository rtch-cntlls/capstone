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
        Schema::table('motorcycle_maintenance_logs', function (Blueprint $table) {
            $table->text('remarks')->nullable()->after('next_due_mileage');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('motorcycle_maintenance_logs', function (Blueprint $table) {
            $table->dropColumn('remarks');
        });
    }
};
