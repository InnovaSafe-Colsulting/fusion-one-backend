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
        Schema::create('inventory_transfer_items', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the transfer item');
            $table->foreignId('transfer_id')->constrained('inventory_transfers')->cascadeOnDelete()->comment('Transfer the item belongs to');
            $table->foreignId('product_id')->constrained('products')->comment('Transferred product');
            $table->decimal('quantity', 12, 4)->comment('Transferred quantity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_transfer_items');
    }
};
