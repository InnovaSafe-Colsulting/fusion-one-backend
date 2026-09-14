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
        Schema::create('products', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the product');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the product');
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete()->comment('Category the product belongs to');
            $table->string('name', 150)->comment('Product name');
            $table->string('sku', 100)->comment('Unique internal product code within the tenant');
            $table->string('barcode', 100)->nullable()->comment('Product barcode');
            $table->text('description')->nullable()->comment('Product description');
            $table->foreignId('type_product_id')->constrained('product_types')->comment('Product type');
            $table->decimal('cost', 12, 2)->default(0)->comment('Product cost');
            $table->decimal('price', 12, 2)->default(0)->comment('Product sale price');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the product is available');
            $table->timestamps();

            $table->unique(['tenant_id', 'sku'], 'products_tenant_sku_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
