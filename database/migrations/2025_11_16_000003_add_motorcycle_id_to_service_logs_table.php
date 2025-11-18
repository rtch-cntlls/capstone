<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('motorcycle_id')->nullable()->after('id');
            $table->foreign('motorcycle_id')->references('motorcycle_id')->on('motorcycles')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('service_logs', function (Blueprint $table) {
            $table->dropForeign(['motorcycle_id']);
            $table->dropColumn('motorcycle_id');
        });
    }
};
