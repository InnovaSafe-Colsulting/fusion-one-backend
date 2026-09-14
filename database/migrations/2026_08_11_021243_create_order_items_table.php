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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the order detail');
            $table->foreignId('order_id')->constrained('orders')->cascadeOnDelete()->comment('Order the detail belongs to');
            $table->foreignId('product_id')->constrained('products')->comment('Product sold');
            $table->foreignId('product_variant_id')->nullable()->constrained('product_variants')->nullOnDelete()->comment('Selected product variant, if applicable');
            $table->decimal('quantity', 12, 4)->comment('Quantity of the product requested');
            $table->decimal('unit_price', 12, 2)->comment('Unit price applied at the time of sale');
            $table->decimal('discount', 12, 2)->default(0)->comment('Discount applied to the item');
            $table->decimal('tax', 12, 2)->default(0)->comment('Tax applied to the item');
            $table->decimal('subtotal', 12, 2)->comment('Item subtotal before the order total');
            $table->text('notes')->nullable()->comment('Product-specific observations');
            $table->string('status', 30)->comment('Status of the item within the order process');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
