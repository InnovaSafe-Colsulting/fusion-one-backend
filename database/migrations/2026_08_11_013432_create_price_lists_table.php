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
        Schema::create('price_lists', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the price list');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the price list');
            $table->string('name', 100)->comment('Price list name');
            $table->text('description')->nullable()->comment('Price list description');
            $table->boolean('is_default')->default(false)->comment('Indicates whether this is the default price list');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the price list is active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_lists');
    }
};
