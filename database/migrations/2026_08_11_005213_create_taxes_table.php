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
        Schema::create('taxes', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the tax');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant the tax belongs to');
            $table->string('name', 100)->comment('Tax name');
            $table->string('code', 50)->comment('Internal tax code');
            $table->decimal('rate', 8, 4)->comment('Tax percentage or rate');
            $table->string('type', 30)->nullable()->comment('Tax type');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the tax is active');
            $table->timestamps();

            $table->unique(['tenant_id', 'code'], 'taxes_tenant_code_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('taxes');
    }
};
