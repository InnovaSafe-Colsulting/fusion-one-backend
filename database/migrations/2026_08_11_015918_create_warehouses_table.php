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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the warehouse');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the warehouse');
            $table->foreignId('branch_id')->constrained('branches')->comment('Branch the warehouse belongs to');
            $table->string('name', 150)->comment('Warehouse name');
            $table->string('code', 50)->comment('Internal warehouse code');
            $table->foreignId('warehouse_type_id')->nullable()->constrained('warehouse_types')->nullOnDelete()->comment('Warehouse type');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the warehouse is active');
            $table->timestamps();

            $table->unique(['tenant_id', 'code'], 'warehouses_tenant_code_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
