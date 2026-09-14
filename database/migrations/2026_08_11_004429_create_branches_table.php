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
        Schema::create('branches', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the branch');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Company the branch belongs to');
            $table->string('name', 150)->comment('Branch name');
            $table->string('code', 50)->comment('Unique internal code of the branch within the tenant');
            $table->string('address', 255)->nullable()->comment('Physical address of the branch');
            $table->string('phone', 50)->nullable()->comment('Branch phone number');
            $table->string('email', 150)->nullable()->comment('Branch email address');
            $table->foreignId('city_id')->constrained('cities')->comment('City where the branch is located');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the branch is active');
            $table->timestamps();

            $table->unique(['tenant_id', 'code'], 'branches_tenant_code_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
