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
        Schema::create('tenant_settings', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the setting');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant the setting belongs to');
            $table->string('key', 100)->comment('Setting key or name');
            $table->text('value')->nullable()->comment('Setting value; can represent different data types');
            $table->timestamps();

            $table->unique(['tenant_id', 'key'], 'tenant_settings_tenant_key_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenant_settings');
    }
};
