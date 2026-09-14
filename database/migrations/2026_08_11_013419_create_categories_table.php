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
        Schema::create('categories', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the category');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant the category belongs to');
            $table->unsignedBigInteger('parent_id')->nullable()->comment('Parent category; allows creating categories and subcategories');
            $table->string('name', 100)->comment('Category name');
            $table->string('slug', 100)->comment('Text identifier for the category');
            $table->text('description')->nullable()->comment('Category description');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the category is active');
            $table->timestamps();

            $table->unique(['tenant_id', 'slug'], 'categories_tenant_slug_unique');
            $table->foreign('parent_id')->references('id')->on('categories')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
