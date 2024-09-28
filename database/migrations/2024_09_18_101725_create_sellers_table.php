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
        Schema::create('sellers', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('profile')->nullable(); // Profile picture URL or file path
            $table->string('email')->unique(); // Unique email address for the seller
            $table->string('password'); // Hashed password
            $table->boolean('is_active_account')->default(true); // Account status, defaults to active
            $table->boolean('is_email_verified')->default(false); // Email verification status, defaults to false
            $table->text('address')->nullable(); // Seller's address (optional)
            $table->string('gst_number')->nullable(); // Seller's GST number, optional for non-registered sellers
            $table->string('name'); // Seller's name
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sellers');
    }
};
