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
        Schema::create('inventory_adjustments', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the inventory adjustment');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the adjustment');
            $table->foreignId('warehouse_id')->constrained('warehouses')->comment('Warehouse where the adjustment is performed');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()->comment('User who performed the adjustment');
            $table->string('reason', 255)->nullable()->comment('Reason for the adjustment');
            $table->string('status', 30)->comment('Adjustment status');
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_adjustments');
    }
};
