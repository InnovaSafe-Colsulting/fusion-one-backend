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
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the ingredient');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the ingredient');
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete()->comment('Ingredient category');
            $table->string('name', 150)->comment('Ingredient name');
            $table->string('sku', 100)->comment('Internal ingredient code');
            $table->string('unit', 30)->comment('Unit of measure used to control the ingredient');
            $table->decimal('cost', 12, 4)->default(0)->comment('Cost per unit of the ingredient');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the ingredient is active');
            $table->timestamps();

            $table->unique(['tenant_id', 'sku'], 'ingredients_tenant_sku_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ingredients');
    }
};
