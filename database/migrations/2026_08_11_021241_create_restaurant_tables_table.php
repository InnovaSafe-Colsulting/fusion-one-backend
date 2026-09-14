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
        Schema::create('restaurant_tables', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the table');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the table');
            $table->foreignId('branch_id')->constrained('branches')->comment('Branch where the table is located');
            $table->string('name', 50)->comment('Visible name or number of the table');
            $table->integer('capacity')->comment('Maximum number of people the table can serve');
            $table->string('status', 30)->default('available')->comment('Current status of the table');
            $table->decimal('position_x', 10, 2)->nullable()->comment('Horizontal position of the table on the restaurant floor plan');
            $table->decimal('position_y', 10, 2)->nullable()->comment('Vertical position of the table on the restaurant floor plan');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the table is available for operation');

            $table->unique(['branch_id', 'name'], 'restaurant_tables_branch_name_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurant_tables');
    }
};
