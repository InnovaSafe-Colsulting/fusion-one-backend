<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payment_method_configs', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the config entry');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant the config belongs to');
            $table->foreignId('payment_method_id')->constrained('payment_methods')->cascadeOnDelete()->comment('Payment method this config belongs to');
            $table->string('key', 100)->comment('Config field name, e.g. phone, account_name, bank_name');
            $table->text('value')->comment('Value visible to the customer for this field');
            $table->boolean('is_active')->default(true)->comment('Indicates whether this config entry is active');
            $table->timestamps();

            $table->unique(['tenant_id', 'payment_method_id', 'key'], 'payment_method_configs_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payment_method_configs');
    }
};
