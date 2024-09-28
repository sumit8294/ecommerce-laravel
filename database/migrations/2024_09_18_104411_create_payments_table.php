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
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id'); // Foreign key for the user making the payment
            $table->string('payment_method'); // Payment gateway used (e.g., 'razorpay', 'paypal', 'stripe')
            $table->string('payment_id')->unique(); // Payment ID from the payment gateway (transaction ID)
            $table->decimal('amount', 10, 2); // Amount paid
            $table->string('currency', 3)->default('INR'); // Currency used for the transaction, default to 'INR'
            $table->string('status'); // Payment status (e.g., 'pending', 'completed', 'failed')
            $table->string('payment_gateway_response')->nullable(); // Store payment gateway response (JSON or serialized)
            $table->timestamps(); // Created and updated timestamps

            // Foreign key constraints
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
