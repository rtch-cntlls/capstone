<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('service_logs', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
        });

        Schema::table('service_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('service_id')->nullable()->change();
            $table->foreign('service_id')->references('service_id')->on('services')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('service_logs', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
        });

        Schema::table('service_logs', function (Blueprint $table) {
            $table->unsignedBigInteger('service_id')->nullable(false)->change();
            $table->foreign('service_id')->references('service_id')->on('services')->onDelete('cascade');
        });
    }
};
