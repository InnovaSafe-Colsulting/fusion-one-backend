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
        Schema::create('inventory', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the inventory record');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the inventory record');
            $table->foreignId('warehouse_id')->constrained('warehouses')->comment('Warehouse where the inventory is located');
            $table->foreignId('product_id')->constrained('products')->comment('Product tracked in inventory');
            $table->decimal('quantity', 12, 4)->default(0)->comment('Physical quantity available of the product');
            $table->decimal('reserved_quantity', 12, 4)->default(0)->comment('Reserved quantity not available for new sales');
            $table->decimal('average_cost', 12, 4)->default(0)->comment('Current average cost of the product');

            $table->unique(['warehouse_id', 'product_id'], 'inventory_warehouse_product_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory');
    }
};
