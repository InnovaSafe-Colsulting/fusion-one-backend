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
        Schema::create('price_list_items', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the price list item');
            $table->foreignId('price_list_id')->constrained('price_lists')->cascadeOnDelete()->comment('Price list the item belongs to');
            $table->foreignId('product_id')->constrained('products')->comment('Product whose price is configured');
            $table->decimal('price', 12, 2)->comment('Product price in this list');

            $table->unique(['price_list_id', 'product_id'], 'price_list_items_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_list_items');
    }
};
