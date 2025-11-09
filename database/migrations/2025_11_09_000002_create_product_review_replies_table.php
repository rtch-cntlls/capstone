<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('product_review_replies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('review_id');
            $table->unsignedBigInteger('admin_user_id');
            $table->text('comment');
            $table->timestamps();

            $table->foreign('review_id')->references('id')->on('product_reviews')->cascadeOnDelete();
            $table->foreign('admin_user_id')->references('user_id')->on('users')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_review_replies');
    }
};
