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
        Schema::create('delivery_orders', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the delivery order');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the delivery');
            $table->foreignId('branch_id')->constrained('branches')->comment('Branch that manages the delivery');
            $table->foreignId('order_id')->nullable()->constrained('orders')->nullOnDelete()->comment('Order associated with the delivery');
            $table->foreignId('customer_id')->constrained('customers')->comment('Customer receiving the order');
            $table->foreignId('driver_id')->nullable()->constrained('employees')->nullOnDelete()->comment('Driver in charge of the order');
            $table->string('address', 255)->comment('Address where the order must be delivered');
            $table->decimal('latitude', 10, 7)->nullable()->comment('Geographic latitude of the delivery point');
            $table->decimal('longitude', 10, 7)->nullable()->comment('Geographic longitude of the delivery point');
            $table->string('status', 30)->comment('Delivery status');
            $table->decimal('delivery_fee', 12, 2)->default(0)->comment('Fee charged for the delivery service');
            $table->timestamp('delivered_at')->nullable()->comment('Date and time the order is delivered');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_orders');
    }
};
