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
        Schema::create('loyalty_accounts', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the loyalty account');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the account');
            $table->foreignId('customer_id')->constrained('customers')->comment('Customer associated with the account');
            $table->integer('points_balance')->default(0)->comment('Current customer points balance');
            $table->timestamps();

            $table->unique(['tenant_id', 'customer_id'], 'loyalty_accounts_tenant_customer_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loyalty_accounts');
    }
};
