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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the invoice');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that issues the invoice');
            $table->foreignId('branch_id')->constrained('branches')->comment('Branch that issues the invoice');
            $table->foreignId('order_id')->constrained('orders')->comment('Order that originates the invoice');
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete()->comment('Customer associated with the invoice');
            $table->unsignedBigInteger('invoice_number')->comment('Consecutive invoice number');
            $table->string('prefix', 20)->nullable()->comment('Invoice prefix');
            $table->decimal('subtotal', 12, 2)->comment('Invoice subtotal');
            $table->decimal('discount', 12, 2)->default(0)->comment('Applied discount');
            $table->decimal('tax', 12, 2)->default(0)->comment('Invoice taxes');
            $table->decimal('tip', 12, 2)->default(0)->comment('Tip included in the invoice');
            $table->decimal('total', 12, 2)->comment('Final invoice total');
            $table->string('status', 30)->comment('Invoice status');
            $table->timestamp('issued_at')->nullable()->comment('Date and time of issuance');

            $table->unique(['tenant_id', 'prefix', 'invoice_number'], 'invoices_tenant_prefix_number_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
