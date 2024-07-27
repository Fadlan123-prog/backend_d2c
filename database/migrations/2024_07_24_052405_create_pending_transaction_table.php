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
        Schema::create('pending_transaction', function (Blueprint $table) {
            $table->id();
            $table->char('plate_number', 10);
            $table->date('date');
            $table->time('time');
            $table->string('cashier_name', 100);
            $table->json('item_name');
            $table->json('item_price');
            $table->integer('total_price');
            $table->string('payment_method', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pending_trancsaction');
    }
};
