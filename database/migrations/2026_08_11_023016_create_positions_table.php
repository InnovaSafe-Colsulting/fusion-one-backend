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
        Schema::create('positions', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the position');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the position');
            $table->string('name', 100)->comment('Position name, e.g. Waiter, Cashier or Cook');
            $table->text('description')->nullable()->comment('Position description');

            $table->unique(['tenant_id', 'name'], 'positions_tenant_name_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('positions');
    }
};
