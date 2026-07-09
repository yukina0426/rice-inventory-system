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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_stock_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->date('sale_date');
            $table->string('customer_name')->nullable();
            $table->string('size');
            $table->integer('quantity');
            $table->integer('unit_price');
            $table->integer('total_price');
            $table->string('sale_method')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
