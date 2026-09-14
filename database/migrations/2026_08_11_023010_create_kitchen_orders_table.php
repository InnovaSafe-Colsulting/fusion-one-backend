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
        Schema::create('kitchen_orders', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the kitchen record');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the order');
            $table->foreignId('branch_id')->constrained('branches')->comment('Branch where the order is processed');
            $table->foreignId('order_id')->constrained('orders')->comment('Order being processed by the kitchen');
            $table->string('status', 30)->comment('Order status within the kitchen');
            $table->integer('priority')->default(0)->comment('Preparation priority');
            $table->timestamp('received_at')->nullable()->comment('Date and time the kitchen receives the order');
            $table->timestamp('started_at')->nullable()->comment('Date and time preparation begins');
            $table->timestamp('ready_at')->nullable()->comment('Date and time the order is ready');
            $table->timestamp('delivered_at')->nullable()->comment('Date and time the order is delivered');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kitchen_orders');
    }
};
