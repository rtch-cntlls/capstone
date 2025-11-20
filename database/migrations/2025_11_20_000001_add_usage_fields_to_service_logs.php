<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('service_logs', function (Blueprint $table) {
            $table->string('road_condition')->nullable()->after('remarks');
            $table->string('usage_frequency')->nullable()->after('road_condition');
        });
    }

    public function down(): void
    {
        Schema::table('service_logs', function (Blueprint $table) {
            $table->dropColumn(['road_condition', 'usage_frequency']);
        });
    }
};
