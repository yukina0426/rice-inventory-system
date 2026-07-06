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
        Schema::create('product_stocks', function (Blueprint $table) {
            $table->id();
            // 商品ID（外部キー）
            $table->foreignId('product_id')
                ->constrained()
                ->cascadeOnDelete();

            // 年産
            $table->integer('crop_year');

            // 在庫数
            $table->integer('stock_5kg')->default(0);
            $table->integer('stock_10kg')->default(0);
            $table->integer('stock_20kg')->default(0);
            $table->integer('stock_30kg')->default(0);

            // 作成日時・更新日時
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_stocks');
    }
};
