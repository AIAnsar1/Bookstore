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
        // Drop the incorrect foreign key constraint
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        // Re-add the correct foreign key constraint
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        // Re-add the original (incorrect) constraint for rollback
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('user_id')
                  ->references('id')
                  ->on('categories')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
        });
    }
};
