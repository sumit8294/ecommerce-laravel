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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // Foreign key for user
            $table->unsignedBigInteger('seller_id'); // Foreign key for seller
            $table->unsignedBigInteger('product_id'); // Foreign key for product
            $table->integer('quantity'); // Quantity of the product ordered
            $table->string('status'); // Order status (e.g., pending, completed, cancelled)
            $table->text('address'); // Shipping address for the order
            $table->unsignedBigInteger('payment_id'); // Foreign key for payment
            $table->timestamps(); // Created and updated timestamps

            // Foreign key constraints
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('seller_id')->references('id')->on('sellers')->onDelete('cascade');
            // $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            // $table->foreign('payment_id')->references('id')->on('payments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
