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
        Schema::create('tmp_product_variants', function (Blueprint $table) {
            $table->id();
            $table->text('import_batch');
            $table->text('product_id')->nullable();
            $table->text('name')->nullable();
            $table->text('sku')->nullable();
            $table->text('price')->nullable();
            $table->text('cost')->nullable();
            $table->text('barcode')->nullable();
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
        Schema::dropIfExists('tmp_product_variants');
    }
};
