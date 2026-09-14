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
        Schema::create('orders', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the order');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the order');
            $table->foreignId('branch_id')->constrained('branches')->comment('Branch where the order is generated');
            $table->foreignId('user_id')->constrained('users')->comment('User who creates or manages the order');
            $table->unsignedBigInteger('customer_id')->nullable()->comment('Customer associated with the order');
            $table->foreignId('table_id')->nullable()->constrained('restaurant_tables')->nullOnDelete()->comment('Table associated with the order when applicable');
            $table->unsignedBigInteger('order_number')->comment('Consecutive order number');
            $table->string('type', 30)->comment('Order type, e.g. table, takeaway or delivery');
            $table->string('status', 30)->comment('Current order status');
            $table->decimal('subtotal', 12, 2)->default(0)->comment('Subtotal before discounts, taxes and tips');
            $table->decimal('discount', 12, 2)->default(0)->comment('Discount applied to the order');
            $table->decimal('tax', 12, 2)->default(0)->comment('Taxes calculated for the order');
            $table->decimal('tip', 12, 2)->default(0)->comment('Tip associated with the order');
            $table->decimal('total', 12, 2)->default(0)->comment('Total value of the order');
            $table->text('notes')->nullable()->comment('General order observations');
            $table->timestamp('opened_at')->nullable()->comment('Date and time the order was opened');
            $table->timestamp('closed_at')->nullable()->comment('Date and time the order was closed');
            $table->timestamps();

            $table->unique(['tenant_id', 'branch_id', 'order_number'], 'orders_tenant_branch_number_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
