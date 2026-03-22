<?php

// Author: GitHub Copilot

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('reviews')) {
            return;
        }

        Schema::table('reviews', function (Blueprint $table) {
            if (!Schema::hasColumn('reviews', 'user_id')) {
                $table->unsignedBigInteger('user_id')->nullable()->index();
            }

            if (!Schema::hasColumn('reviews', 'product_id')) {
                $table->unsignedBigInteger('product_id')->nullable()->index();
            }

            if (!Schema::hasColumn('reviews', 'rating')) {
                $table->unsignedTinyInteger('rating')->nullable();
            }

            if (!Schema::hasColumn('reviews', 'comment')) {
                $table->text('comment')->nullable();
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('reviews')) {
            return;
        }

        Schema::table('reviews', function (Blueprint $table) {
            if (Schema::hasColumn('reviews', 'comment')) {
                $table->dropColumn('comment');
            }

            if (Schema::hasColumn('reviews', 'rating')) {
                $table->dropColumn('rating');
            }

            if (Schema::hasColumn('reviews', 'product_id')) {
                $table->dropIndex(['product_id']);
                $table->dropColumn('product_id');
            }

            if (Schema::hasColumn('reviews', 'user_id')) {
                $table->dropIndex(['user_id']);
                $table->dropColumn('user_id');
            }
        });
    }
};
