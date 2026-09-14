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
        Schema::create('shifts', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the shift');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant that owns the shift');
            $table->foreignId('branch_id')->constrained('branches')->comment('Branch where the shift takes place');
            $table->foreignId('employee_id')->constrained('employees')->comment('Employee who works the shift');
            $table->timestamp('starts_at')->nullable()->comment('Shift start date and time');
            $table->timestamp('ends_at')->nullable()->comment('Shift end date and time');
            $table->string('status', 30)->comment('Shift status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shifts');
    }
};
