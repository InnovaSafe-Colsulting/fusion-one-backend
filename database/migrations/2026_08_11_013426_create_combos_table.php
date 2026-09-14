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
        Schema::create('combos', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the combo');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the combo');
            $table->string('name', 150)->comment('Combo name');
            $table->text('description')->nullable()->comment('Combo description');
            $table->decimal('price', 12, 2)->comment('Combo sale price');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the combo is available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('combos');
    }
};
