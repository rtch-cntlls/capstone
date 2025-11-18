<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_logs', function (Blueprint $table) {
            $table->integer('next_due_mileage')->nullable()->after('last_service_type');
            $table->date('next_due_date')->nullable()->after('next_due_mileage');
            $table->text('ai_reasoning')->nullable()->after('next_due_date');
            $table->text('remarks')->nullable()->after('ai_reasoning');
        });
    }

    public function down(): void
    {
        Schema::table('service_logs', function (Blueprint $table) {
            $table->dropColumn(['next_due_mileage', 'next_due_date', 'ai_reasoning', 'remarks']);
        });
    }
};
