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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the payment method');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant the payment method belongs to');
            $table->string('name', 100)->comment('Payment method name, e.g. Cash or Card');
            $table->string('code', 50)->comment('Internal payment method code');
            $table->string('type', 30)->comment('Payment method type');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the payment method is available');
            $table->timestamps();

            $table->unique(['tenant_id', 'code'], 'payment_methods_tenant_code_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_methods');
    }
};
