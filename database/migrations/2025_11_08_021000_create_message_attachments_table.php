<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('message_attachments', function (Blueprint $table) {
            $table->id('attachment_id');
            $table->unsignedBigInteger('message_id');
            $table->string('attachment_path');
            $table->string('attachment_type');
            $table->string('mime_type')->nullable();
            $table->string('thumbnail_path')->nullable();
            $table->timestamps();

            $table->foreign('message_id')->references('message_id')->on('messages')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('message_attachments');
    }
};
