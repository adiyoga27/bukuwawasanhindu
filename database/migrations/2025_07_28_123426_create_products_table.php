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
            $table->string('title');
            $table->string('author');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->integer('discount')->default(0);
            $table->decimal('rating', 3, 2)->default(0);
            $table->text('description');
            $table->double('stars')->default(0);
            $table->string('slug')->unique();
            $table->boolean('is_active')->default(true);
            $table->string('thumbnail')->nullable();
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
