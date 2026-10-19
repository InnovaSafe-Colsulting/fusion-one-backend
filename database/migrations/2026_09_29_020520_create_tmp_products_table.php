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
        Schema::create('tmp_products', function (Blueprint $table) {
            $table->id();
            $table->text('import_batch');
            $table->text('tenant_id')->nullable();
            $table->text('category_id')->nullable();
            $table->text('name')->nullable();
            $table->text('sku')->nullable();
            $table->text('barcode')->nullable();
            $table->text('description')->nullable();
            $table->text('type_product_id')->nullable();
            $table->text('cost')->nullable();
            $table->text('price')->nullable();
            $table->text('is_active')->nullable();
            $table->text('error')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tmp_products');
    }
};
