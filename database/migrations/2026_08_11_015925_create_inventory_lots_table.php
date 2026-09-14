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
        Schema::create('inventory_lots', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the lot');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the lot');
            $table->foreignId('warehouse_id')->constrained('warehouses')->comment('Warehouse where the lot is stored');
            $table->foreignId('product_id')->constrained('products')->comment('Product associated with the lot');
            $table->string('lot_number', 100)->comment('Lot number or code');
            $table->decimal('quantity', 12, 4)->comment('Available quantity in the lot');
            $table->date('expiration_date')->nullable()->comment('Lot expiration date');
            $table->decimal('unit_cost', 12, 4)->nullable()->comment('Unit cost of the product in this lot');

            $table->unique(['tenant_id', 'product_id', 'lot_number'], 'inventory_lots_tenant_product_lot_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_lots');
    }
};
