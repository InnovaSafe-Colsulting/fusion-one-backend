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
        Schema::create('promotion_products', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the relationship');
            $table->foreignId('promotion_id')->constrained('promotions')->cascadeOnDelete()->comment('Associated promotion');
            $table->foreignId('product_id')->constrained('products')->comment('Product included in the promotion');

            $table->unique(['promotion_id', 'product_id'], 'promotion_products_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('promotion_products');
    }
};
