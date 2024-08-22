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
        Schema::create('coupons', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name'); // Coupon name
            $table->text('description')->nullable(); // Description, can be null
            $table->foreignId('category_id')->constrained()->onDelete('cascade'); // Reference to categories table
            $table->decimal('discount_amount', 10, 2)->nullable(); // Fixed discount amount, nullable
            $table->decimal('discount_percentage', 5, 2)->nullable(); // Discount percentage, nullable
            $table->date('expired_date'); // Expiration date
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
