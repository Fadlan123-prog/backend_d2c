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
        Schema::create('pending_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pending_transaction_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('size_id')->nullable();
            $table->decimal('harga_items', 8, 2);
            $table->integer('quantity')->nullable();
            $table->timestamps();

            $table->foreign('pending_transaction_id')->references('id')->on('pending_transaction')->onDelete('cascade');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('size_id')->references('id')->on('sizes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_items');
    }
};
