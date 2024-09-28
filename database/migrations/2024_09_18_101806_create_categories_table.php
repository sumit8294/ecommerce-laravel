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
        Schema::create('categories', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name'); // Category name
            $table->unsignedBigInteger('parent_id')->nullable(); // For nested categories (nullable for root categories)
            $table->text('description')->nullable(); // Description of the category
            $table->string('tags')->nullable(); // Tags for the category (comma-separated values)
            $table->timestamps(); // Created and updated timestamps

            // Foreign key constraint for parent category
           // $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
