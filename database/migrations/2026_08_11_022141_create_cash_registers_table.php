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
        Schema::create('cash_registers', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the cash register');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the cash register');
            $table->foreignId('branch_id')->constrained('branches')->comment('Branch where the cash register is located');
            $table->string('name', 100)->comment('Cash register name');
            $table->string('code', 50)->comment('Internal cash register code');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the cash register is active');

            $table->unique(['branch_id', 'code'], 'cash_registers_branch_code_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_registers');
    }
};
