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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->foreignId('publish_id')->nullable()->constrained('publishers')->nullOnDelete();            
            $table->string('title');
            $table->string('isbn')->unique();
            $table->text('description')->nullable();
            $table->year('publish_year');
            $table->integer('number_of_pages');
            $table->integer('number_of_copies');
            $table->decimal('price', 8, 2);
            $table->string('cover_image')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
