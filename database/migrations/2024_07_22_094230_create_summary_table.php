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
        Schema::create('summary', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('item');
            $table->string('category');
            $table->integer('item_sold');
            $table->string('employee_name');
            $table->string('payment_type');
            $table->integer('total_payment');
            $table->integer('gross_sale');
            $table->integer('refund');
            $table->integer('discount');
            $table->integer('net_sales');
            $table->integer('cost_of_goods');
            $table->integer('gross_profit');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('summary');
    }
};
