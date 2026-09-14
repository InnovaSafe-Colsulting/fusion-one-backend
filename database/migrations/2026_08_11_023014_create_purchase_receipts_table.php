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
        Schema::create('purchase_receipts', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the purchase receipt');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the receipt');
            $table->foreignId('purchase_order_id')->constrained('purchase_orders')->comment('Purchase order being received');
            $table->foreignId('warehouse_id')->constrained('warehouses')->comment('Warehouse where products are received');
            $table->foreignId('user_id')->constrained('users')->comment('User who registers the receipt');
            $table->timestamp('received_at')->nullable()->comment('Date and time of receipt');
            $table->string('status', 30)->comment('Receipt status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_receipts');
    }
};
