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
        Schema::create('employees', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the employee');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant the employee belongs to');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete()->comment('FusionOne user associated with the employee');
            $table->foreignId('branch_id')->constrained('branches')->comment('Employee primary branch');
            $table->string('document_type', 30)->nullable()->comment('Employee document type');
            $table->string('document_number', 50)->nullable()->comment('Employee document number');
            $table->string('first_name', 100)->comment('Employee first name');
            $table->string('last_name', 100)->nullable()->comment('Employee last name');
            $table->string('phone', 50)->nullable()->comment('Employee phone number');
            $table->string('email', 150)->nullable()->comment('Employee email address');
            $table->date('hire_date')->nullable()->comment('Hire date');
            $table->string('status', 30)->comment('Employee employment status');

            $table->unique(['tenant_id', 'document_type', 'document_number'], 'employees_tenant_document_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
