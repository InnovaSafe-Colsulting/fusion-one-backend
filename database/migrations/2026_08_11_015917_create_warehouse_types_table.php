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
        Schema::create('warehouse_types', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the warehouse type');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Company the warehouse type belongs to');
            $table->string('name', 100)->comment('Warehouse type name, e.g. Main, Kitchen, Bar');
            $table->string('slug', 100)->comment('System-readable identifier, e.g. main, kitchen, bar');
            $table->text('description')->nullable()->comment('Optional description of the purpose of this warehouse type');
            $table->boolean('is_system')->default(false)->comment('Indicates if the type was created by FusionOne or by the user');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the type is available for use');
            $table->timestamps();

            $table->unique(['tenant_id', 'slug'], 'warehouse_types_tenant_slug_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouse_types');
    }
};
