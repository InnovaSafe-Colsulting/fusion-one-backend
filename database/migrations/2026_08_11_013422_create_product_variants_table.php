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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the variant');
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete()->comment('Main product the variant belongs to');
            $table->string('name', 100)->comment('Variant name, e.g. Large or Medium');
            $table->string('sku', 100)->comment('Variant-specific SKU');
            $table->decimal('price', 12, 2)->default(0)->comment('Variant sale price');
            $table->decimal('cost', 12, 2)->default(0)->comment('Variant cost');
            $table->string('barcode', 100)->nullable()->comment('Variant barcode');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the variant is active');
            $table->timestamps();

            $table->unique(['product_id', 'sku'], 'product_variants_product_sku_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
