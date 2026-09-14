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
        Schema::create('inventory_movements', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the inventory movement');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the movement');
            $table->foreignId('warehouse_id')->constrained('warehouses')->comment('Warehouse affected by the movement');
            $table->foreignId('product_id')->constrained('products')->comment('Product affected');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()->comment('User who performed the movement');
            $table->string('type', 50)->comment('Movement type, e.g. entry, exit or adjustment');
            $table->decimal('quantity', 12, 4)->comment('Quantity affected by the movement');
            $table->decimal('unit_cost', 12, 4)->nullable()->comment('Unit cost associated with the movement');
            $table->string('reference_type', 100)->nullable()->comment('Type of entity that originated the movement');
            $table->unsignedBigInteger('reference_id')->nullable()->comment('Identifier of the record that originated the movement');
            $table->text('notes')->nullable()->comment('Movement observations');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_movements');
    }
};
