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
        // Drop the existing foreign key constraint
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['tarif_id']);
        });

        // Re-add the foreign key constraint with the correct table name
        Schema::table('payments', function (Blueprint $table) {
            $table->foreign('tarif_id')
                  ->references('id')
                  ->on('tarives')
                  ->cascadeOnUpdate()
                  ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['tarif_id']);
        });
    }
};
