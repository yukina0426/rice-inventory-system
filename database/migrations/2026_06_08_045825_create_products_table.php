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
            $table->id();
            $table->string('variety')->nullable(); // 品種
            $table->integer('stock_5kg')->default(0);
            $table->integer('stock_10kg')->default(0);
            $table->integer('stock_20kg')->default(0);
            $table->integer('stock_30kg')->default(0);
            $table->integer('price_5kg')->default(0);
            $table->integer('price_10kg')->default(0);
            $table->integer('price_20kg')->default(0);
            $table->integer('price_30kg')->default(0);
            $table->text('description')->nullable(); // 説明
            $table->timestamps();
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
