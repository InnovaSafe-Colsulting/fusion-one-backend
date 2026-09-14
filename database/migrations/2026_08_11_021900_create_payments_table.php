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
        Schema::create('payments', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the payment');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that receives the payment');
            $table->foreignId('branch_id')->constrained('branches')->comment('Branch where the payment is registered');
            $table->foreignId('order_id')->constrained('orders')->comment('Order associated with the payment');
            $table->foreignId('payment_method_id')->constrained('payment_methods')->comment('Payment method used');
            $table->decimal('amount', 12, 2)->comment('Amount paid');
            $table->string('reference', 150)->nullable()->comment('External payment reference, e.g. transaction number');
            $table->string('status', 30)->comment('Payment status');
            $table->timestamp('paid_at')->nullable()->comment('Date and time the payment was made');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
