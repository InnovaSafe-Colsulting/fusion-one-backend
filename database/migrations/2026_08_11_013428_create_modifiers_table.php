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
        Schema::create('modifiers', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the modifier');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the modifier');
            $table->string('name', 100)->comment('Modifier group name');
            $table->string('selection_type', 30)->comment('Defines how the customer can select options');
            $table->integer('min_selection')->default(0)->comment('Minimum number of options that must be selected');
            $table->integer('max_selection')->nullable()->comment('Maximum number of options that can be selected');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the modifier is available');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modifiers');
    }
};
