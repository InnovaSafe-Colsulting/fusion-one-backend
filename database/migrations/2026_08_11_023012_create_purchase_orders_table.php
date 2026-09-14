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
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the purchase order');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the order');
            $table->foreignId('branch_id')->constrained('branches')->comment('Branch that places the purchase');
            $table->foreignId('supplier_id')->constrained('suppliers')->comment('Supplier the order is placed with');
            $table->foreignId('user_id')->constrained('users')->comment('User who creates the purchase order');
            $table->unsignedBigInteger('number')->comment('Consecutive purchase order number');
            $table->string('status', 30)->comment('Purchase order status');
            $table->decimal('subtotal', 12, 2)->default(0)->comment('Order subtotal');
            $table->decimal('tax', 12, 2)->default(0)->comment('Order taxes');
            $table->decimal('total', 12, 2)->default(0)->comment('Order total');
            $table->timestamp('ordered_at')->nullable()->comment('Date and time the order is generated');

            $table->unique(['tenant_id', 'branch_id', 'number'], 'purchase_orders_tenant_branch_number_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_orders');
    }
};
