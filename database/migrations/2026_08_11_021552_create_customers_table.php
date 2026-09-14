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
        Schema::create('customers', function (Blueprint $table) {
            $table->id()->comment('Unique identifier for the customer');
            $table->foreignId('tenant_id')->constrained('tenants')->comment('Tenant the customer belongs to');
            $table->string('document_type', 30)->nullable()->comment('Customer document type');
            $table->string('document_number', 50)->nullable()->comment('Customer document number');
            $table->string('first_name', 100)->comment('Customer first name');
            $table->string('last_name', 100)->nullable()->comment('Customer last name');
            $table->string('email', 150)->nullable()->comment('Customer email address');
            $table->string('phone', 50)->nullable()->comment('Customer phone number');
            $table->date('birth_date')->nullable()->comment('Customer date of birth');
            $table->text('notes')->nullable()->comment('Additional observations or information about the customer');
            $table->boolean('is_active')->default(true)->comment('Indicates whether the customer is active');
            $table->timestamps();

            $table->unique(['tenant_id', 'document_type', 'document_number'], 'customers_tenant_document_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
