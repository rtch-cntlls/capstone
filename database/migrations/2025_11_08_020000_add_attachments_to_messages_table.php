<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->text('content')->nullable()->change();
            $table->string('attachment_path')->nullable()->after('content');
            $table->string('attachment_type')->nullable()->after('attachment_path');
        });
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->text('content')->nullable(false)->change();
            $table->dropColumn(['attachment_path', 'attachment_type']);
        });
    }
};
