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
        Schema::create('inventory_adjustment_items', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the adjustment item');
            $table->foreignId('adjustment_id')->constrained('inventory_adjustments')->cascadeOnDelete()->comment('Adjustment the item belongs to');
            $table->foreignId('product_id')->constrained('products')->comment('Product affected by the adjustment');
            $table->decimal('previous_quantity', 12, 4)->comment('Quantity recorded before the adjustment');
            $table->decimal('new_quantity', 12, 4)->comment('Quantity recorded after the adjustment');
            $table->decimal('difference', 12, 4)->comment('Difference between the previous and new quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_adjustment_items');
    }
};
