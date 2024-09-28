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
            $table->id(); // Primary key
            $table->string('name'); // Product name
            $table->unsignedBigInteger('category_id'); // Foreign key for categories
            $table->string('sku')->unique(); // Stock Keeping Unit (unique)
            $table->unsignedBigInteger('seller_id'); // Foreign key for seller
            $table->string('image')->nullable(); // Image path, nullable
            $table->boolean('visible')->default(true); // Product visibility
            $table->decimal('ratings', 3, 2)->default(0); // Ratings with precision
            $table->decimal('mrp', 8, 2); // Maximum retail price
            $table->decimal('selling_price', 8, 2); // Selling price
            $table->text('description')->nullable(); // Product description
            $table->integer('quantity'); // Available quantity
            $table->integer('item_sold')->default(0); // Number of items sold
            $table->integer('reach')->default(0); // Number of product views or reach
            $table->string('tags')->nullable(); // Product tags as comma-separated values
            $table->timestamps(); // Created and updated timestamps

            // Foreign key constraints
            // $table->foreign('category_id')->references('id')->on('categories');
            // $table->foreign('seller_id')->references('id')->on('sellers');
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
