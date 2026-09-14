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
        Schema::create('product_types', function (Blueprint $table) {
            $table->id()->comment('Primary identifier');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the product type');
            $table->string('name', 255)->comment('Product type name');
            $table->string('slug', 100)->comment('Text identifier for the product type');
            $table->text('description')->nullable()->comment('Product type description');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the product type is active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_types');
    }
};
