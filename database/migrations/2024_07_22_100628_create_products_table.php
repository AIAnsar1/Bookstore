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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->json('title');
            $table->json('description');
            $table->json('photo');
            $table->text('pdf');
            $table->boolean('selling_method');
            $table->integer('price');
            $table->foreignId('category_id')->constrained('categories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('categories')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('author_id')->constrained('authors')->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
