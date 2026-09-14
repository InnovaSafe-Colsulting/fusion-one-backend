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
        Schema::create('inventory_transfers', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the transfer');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the transfer');
            $table->foreignId('from_warehouse_id')->constrained('warehouses')->comment('Source warehouse');
            $table->foreignId('to_warehouse_id')->constrained('warehouses')->comment('Destination warehouse');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()->comment('User who performed or initiated the transfer');
            $table->string('status', 30)->comment('Transfer status');
            $table->text('notes')->nullable()->comment('Transfer observations');
            $table->timestamp('transferred_at')->nullable()->comment('Date and time the transfer was performed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_transfers');
    }
};
