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
        Schema::create('tenant_fiscal_data', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for fiscal data');
            $table->foreignId('tenant_id')->unique()->constrained('tenants')->comment('Tenant the fiscal data belongs to. Unique because a tenant has only one fiscal record');
            $table->string('tax_id', 50)->comment('Tax identification of the company, e.g. NIT');
            $table->string('verification_digit', 5)->nullable()->comment('Verification digit associated with the tax identifier');
            $table->string('tax_regime', 50)->nullable()->comment('Tax regime the tenant belongs to');
            $table->string('fiscal_address', 255)->nullable()->comment('Registered fiscal address of the company');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_fiscal_data');
    }
};
