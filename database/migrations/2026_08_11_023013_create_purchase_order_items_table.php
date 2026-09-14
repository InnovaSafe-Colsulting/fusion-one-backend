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
        Schema::create('purchase_order_items', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the purchase detail');
            $table->foreignId('purchase_order_id')->constrained('purchase_orders')->cascadeOnDelete()->comment('Purchase order the item belongs to');
            $table->foreignId('product_id')->constrained('products')->comment('Product purchased');
            $table->decimal('quantity', 12, 4)->comment('Requested quantity');
            $table->decimal('unit_cost', 12, 4)->comment('Unit purchase cost');
            $table->decimal('tax', 12, 2)->default(0)->comment('Tax applied to the product');
            $table->decimal('subtotal', 12, 2)->comment('Purchase item subtotal');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_order_items');
    }
};
